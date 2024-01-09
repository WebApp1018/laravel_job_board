class KonvaSketch {
    constructor({
        container,
        width,
        height,
        on_mode_changed,
        on_select_building,
        json = null,
        buildings = []
        // sub_type = null
    }) {
        this.on_mode_changed = on_mode_changed;
        this.on_select_building = on_select_building;
        this.container_id = container;
        // this.sub_type = sub_type;
        this.container = $('#' + container);
        this.plot = null;
        
        this.sketch_canvas = this.container.find('#' + container + '_container');
        this.width = this.sketch_canvas.parent().width() - 2 * parseFloat(this.sketch_canvas.css('border-width'));
        this.height = this.sketch_canvas.parent().height() - 2 * parseFloat(this.sketch_canvas.css('border-width'));
        this.height = height;
        this.width = width;

        this.POSITION_PRECISION = 2;
        this.AREA_PRECISION = 2;
        this.stage = null;
        this.buildings = buildings;
        this.parent_node = null;
        this.plot_canvas_mode = true;
        
        if (json) {
            this.stage = Konva.Node.create(json, container + '_container');
            this.layer = this.stage.getLayers()[0];
            this.layer.find('.rect').forEach(rect => {
                this.set_listeners(rect);
                rect.stroke('gray');
                rect.strokeWidth(0.5);
            });
            this.layer.find('.guid-line').forEach((l) => l.destroy());
            this.trlayer = this.stage.getLayers()[1];
            this.trlayer.clear();
            this.parent_node = this.plot = this.layer.find('.plot')[0];
        }
        else {
            this.stage = new Konva.Stage({
                container: container + '_container',
                width: this.width,
                height: this.height
            });
            this.layer = new Konva.Layer();
            this.stage.add(this.layer);

            this.trlayer = new Konva.Layer();
            this.stage.add(this.trlayer);
        }
        this.tr = new Konva.Transformer({
            ignoreStroke: true,
            rotateEnabled: false,
            flipEnabled: false,
            borderEnabled: false,
            anchorDragBoundFunc: (oldPos, newPos, event) => {
                const dist = Math.sqrt(
                    Math.pow(newPos.x - oldPos.x, 2) + Math.pow(newPos.y - oldPos.y, 2)
                );
                this.layer.find('.guid-line').forEach((l) => l.destroy());
                
                // find possible snapping lines
                var lineGuideStops = this.getLineGuideStops(this.tr.nodes()[0]);
                // find snapping points of current object
                var itemBounds = {
                    vertical: [{
                        guide: newPos.x / this.sketch_canvas_scale,
                        offset: 0, //Math.round(absPos.x - box.x),
                        snap: 'start',
                    }],
                    horizontal: [{
                        guide: newPos.y / this.sketch_canvas_scale,
                        offset: 0, //Math.round(absPos.y - box.y),
                        snap: 'start',
                    }]
                };
                // now find where can we snap current object
                var guides = this.getGuides(lineGuideStops, itemBounds);
                // do nothing of no snapping
                
                this.drawGuides(guides);
                
                guides.forEach((lg) => {
                    switch (lg.orientation) {
                        case 'V': {
                            newPos.x = lg.lineGuide * this.sketch_canvas_scale;
                            break;
                        }
                        case 'H': {
                            newPos.y = lg.lineGuide * this.sketch_canvas_scale;
                            break;
                        }
                    }
                });
                return newPos;
            }
            // padding: -5
        });
        this.trlayer.add(this.tr);
        this.tr.nodes([]);

        this.clipboard = null;
        this.clipboard_building = null;
        this.selected = null;
        this.is_selectable = true;
        this.is_pannable = false;
        this.is_movable = true;
        this.width_input = this.container.find('#length');
        this.width_input.off('change');
        this.width_input.on('change', (e) => this.on_width_change(e));
        this.height_input = this.container.find('#width');
        this.height_input.off('change');
        this.height_input.on('change', (e) => this.on_height_change(e));
        this.x_pos_input = this.container.find('#x_pos');
        this.x_pos_input.off('change');
        this.x_pos_input.on('change', (e) => this.on_x_pos_change(e));
        this.y_pos_input = this.container.find('#y_pos');
        this.y_pos_input.off('change');
        this.y_pos_input.on('change', (e) => this.on_y_pos_change(e));
        this.btn_select = this.container.find('#btn_select');
        this.btn_select.off('click');
        this.btn_select.on('click', (e) => this.toggle_selectable(e));
        this.btn_fullscreen = this.container.find('#btn_fullscreen');
        this.btn_fullscreen.off('click');
        this.btn_fullscreen.on('click', () => this.toggle_fullscreen());
        this.btn_pan = this.container.find('#btn_pan');
        this.btn_pan.off('click');
        this.btn_pan.on('click', (e) => this.toggle_panning(e));
        this.btn_move = this.container.find('#btn_move');
        this.btn_move.off('click');
        this.btn_move.on('click', (e) => this.toggle_movable(e));
        this.btn_delete = this.container.find('#btn_delete');
        this.btn_delete.off('click');
        this.btn_delete.on('click', () => this.delete_node());
        this.btn_undo = this.container.find('#btn_undo');
        this.btn_undo.off('click');
        this.btn_undo.on('click', () => this.undo_history());
        this.btn_redo = this.container.find('#btn_redo');
        this.btn_redo.off('click');
        this.btn_redo.on('click', () => this.redo_history());
        this.btn_zoomin = this.container.find('#btn_zoomin');
        this.btn_zoomin.off('mousedown');
        this.btn_zoomin.on('mousedown', () => this.sketch_canvas_zoom(1));
        this.btn_zoomin.off('mouseup');
        this.btn_zoomin.on('mouseup', () => this.sketch_canvas_zoom_stop());
        this.btn_zoomin.off('mouseleave');
        this.btn_zoomin.on('mouseleave', () => this.sketch_canvas_zoom_stop());
        this.btn_zoomout = this.container.find('#btn_zoomout');
        this.btn_zoomout.off('mousedown');
        this.btn_zoomout.on('mousedown', () => this.sketch_canvas_zoom(-1));
        this.btn_zoomout.off('mouseup');
        this.btn_zoomout.on('mouseup', () => this.sketch_canvas_zoom_stop());
        this.btn_zoomout.off('mouseleave');
        this.btn_zoomout.on('mouseleave', () => this.sketch_canvas_zoom_stop());
        this.error_text = this.container.find('#error_text');
        this.current_floor = 0;

        this.GUIDELINE_OFFSET = 5;
        // this.width = width;
        // this.height = height;
        
        this.is_panning = false;
        this.startPos = null;
        this.scroll = null;
        this.sketch_pan = this.sketch_canvas.parent();
        this.canvas_panel = this.container.find('#canvas_panel');

        this.sketch_pan.off('mousedown');
        this.sketch_pan.on('mousedown', (e) => {
            if (this.is_pannable) {
                this.is_panning = true;
                this.stage.container().style.cursor = 'grabbing';
                this.startPos = {
                    x: e.pageX,
                    y: e.pageY,
                }
                this.scroll = {
                    x: this.sketch_pan.scrollLeft(),
                    y: this.sketch_pan.scrollTop(),
                }
                return;
            }
        });
        this.sketch_pan.off('mousemove');
        this.sketch_pan.on('mousemove', (e) => {
            if (!this.is_panning) return;
            this.sketch_pan.scrollLeft(this.scroll.x - e.pageX + this.startPos.x);
            this.sketch_pan.scrollTop(this.scroll.y - e.pageY + this.startPos.y);
        });
        this.sketch_pan.off('mouseup');
        this.sketch_pan.on('mouseup', (e) => {
            this.is_panning = false;
            this.layer.find('.guid-line').forEach((l) => l.destroy());
        })

        // add a new feature, lets add ability to draw selection rectangle
        // var selectionRectangle = new Konva.Rect({
        //     fill: 'rgba(0,0,255,0.5)',
        //     visible: false,
        // });
        // this.layer.add(selectionRectangle);
        
        this.appHistory = [{
            layer: this.layer.clone(),
            mode: this.plot_canvas_mode,
            parent_id: null,
            current_floor: this.current_floor,
            buildings: []
        }];

        this.appHistoryStep = 0;
        // var x1, y1, x2, y2;
        this.stage.off('mousedown touchstart');
        this.stage.on('mousedown touchstart', (e) => {
            if (this.is_pannable) {
                e.evt.preventDefault();
                return;
            }
            
            // if (this.current_building) {
            //     if (e.target.hasName('room')) {
            //         this.select(e.target);
            //     }
            //     else {
            //         this.deselect();
            //         this.display_property(this.current_building.rect);
            //     }
            //     return ;
            // }

            // do nothing if we mousedown on any shape
            if (e.target === this.stage) {
                this.deselect();
                if (this.plot_canvas_mode) this.set_parent(null);
                this.display_property(this.parent_node ? this.parent_node : e.target);
                return;
            }
            if (this.plot_canvas_mode) {
                if (e.target.hasName('primary')) {
                    this.set_parent(null);
                }
                else this.set_parent(this.plot);
            }
            if (e.target.hasName('rect')) this.select(e.target);
        });

        this.nodes_in_hand = [];

        // this.stage.on('mousemove touchmove', (e) => {
        //     if (!this.is_panning) return;
        // });

        // this.stage.on('mouseup touchend', (e) => {
        //     if (!this.is_panning) return;
        //     this.is_panning = false;
        //     this.stage.container().style.cursor = 'grab';
        // });
        
        // // clicks should select/deselect shapes
        // this.stage.on('click tap', (e) => {
        //     // if click on empty area - remove all selections
        //     if (this.is_pannable) return;
        //     if (this.current_building) {
        //         if (e.target.hasName('room')) {
        //             this.select(e.target);
        //         }
        //         else {
        //             this.deselect();
        //             this.display_property(this.current_building);
        //         }
        //         return ;
        //     }
        //     if (e.target === this.stage) {
        //         this.deselect();
        //         this.display_property(e.target);
        //         return;
        //     }

        //     // if we are selecting with rect, do nothing
        //     // if (selectionRectangle.visible()) {
        //     //     return;
        //     // }

        //     if (!e.target.hasName('rect')) {
        //         return;
        //     }
        //     if (this.is_selectable) {
        //         this.select(e.target);
        //     }
        // });
    
        this.set_layer_listeners();

        this.sketch_canvas_scale = 1;
        this.min_sketch_canvas_scale = 1;

        this.sketch_canvas_zoom_interval = null;
        this.parent_sketch_canvas_panel = this.container.find('#canvas_panel').parent();
        this.has_error = false;

        this.sketch_pan.off('wheel');
        this.sketch_pan.on('wheel', (e) => {
            if (!e.ctrlKey) return;
            e.preventDefault();
            let val = e.originalEvent.deltaY > 0 ? -1 : 1;
            let scroll = { left: this.sketch_pan.scrollLeft(), top: this.sketch_pan.scrollTop() };
            let offset = { x: e.offsetX, y: e.offsetY };
            
            let original = this.sketch_canvas_scale;
            this.sketch_canvas_scale += val * 0.05 * this.sketch_canvas_scale;
            this.sketch_canvas_scale = Math.max(this.sketch_canvas_scale, this.min_sketch_canvas_scale);
            
            this.setScale();
            // this.sketch_pan.scrollLeft(scroll.left + offset.x * (this.sketch_canvas_scale - original));
            // this.sketch_pan.scrollTop(scroll.top + offset.y * (this.sketch_canvas_scale - original));
        });

        this.fullscreenMode = false;
        this.ctrlDown = false;
        this.set_canvas_mode(true);
            
        this.set_keyevent_listeners();
        this.resize_sketch_canvas();

        this.saveLocalStorage();
    }
    saveLocalStorage() {
        if (localStorage.setItem('canvas_data', JSON.stringify({
            width : this.width,
            height : this.height,
            stage : this.stage.toJSON(),
            buildings: this.buildings
        })));
    }
    set_parent(node) {
        if (node === undefined) node = null; 
        if (this.parent_node) {
            this.parent_node.stroke('gray');
            this.parent_node.strokeWidth(0.5);
        }
        this.parent_node = node;
        if (this.parent_node) {
            this.parent_node.stroke('rgb(244 63 94)');
            this.parent_node.strokeWidth(2);
            this.display_property(this.parent_node);
        }
        this.select(this.selected);
    }
    set_parent_by_id(id) {
        this.set_parent(this.layer.find('#' + id)[0]);
    }
    set_visible(node, visible) {
        var id = node.id();
        node.visible(visible);
        if (visible) node.listening(this.is_selectable);
        this.layer.find(`#${id}_label`)[0].visible(visible);
        this.layer.find(`#${id}_area_label`)[0].visible(visible);
    }
    select_floor(floor) {
        if (!this.parent_node.hasName('building')) return ;
        this.deselect();
        var id = this.parent_node.id();
        this.layer.find('.room').forEach((room) => {
            if (room.id().startsWith(id + '_floor_' + floor)) this.set_visible(room, true);
            else if (floor != 'none' && room.id().startsWith(id + '_stack')) this.set_visible(room, true);
            else this.set_visible(room, false);
        });
        this.current_floor = floor;
        this.check_error();
    }
    set_canvas_mode(mode) {

        this.deselect();
        if (!this.plot_canvas_mode && mode) {
            this.select_floor('none');
            this.set_parent(this.plot);
        }

        this.plot_canvas_mode = mode;

        this.layer.find('.primary').forEach(node => {
            node.listening(this.is_selectable && !this.is_pannable && mode);
        });
        this.layer.find('.node').forEach(node => {
            node.listening(this.is_selectable && !this.is_pannable && mode);
        });
        this.layer.find('.room').forEach(node => {
            node.visible(!mode);
        });
    }
    set_keyevent_listeners() {
        $(document).off("keydown");
        $(document).off("keyup");

        $(document).keydown((event) => {
            console.log(event);
            if (event.key == 'Delete') {
                this.delete_node();
            }
            if (event.key == ' ') {
                if (event.target.tagName.toUpperCase() == 'INPUT') return;
                if (!this.is_pannable) {
                    this.toggle_panning();
                    event.preventDefault();
                }
            }
            if (event.key == 'Control') {
                this.ctrlDown = true;
            }
            if (event.key == 'c' && this.ctrlDown) {
                if (this.selected && this.selected !== this.plot) {
                    this.clipboard = [
                        this.selected.attrs,
                        ...this.get_children(this.selected).map(child => {
                            return {
                                ...child.attrs,
                                x: child.attrs.x - this.selected.attrs.x,
                                y: child.attrs.y - this.selected.attrs.y
                            }
                        })
                    ];
                    if (this.selected.hasName('building')) {
                        this.clipboard_building = JSON.parse(JSON.stringify(this.buildings.find(building => building.id == this.selected.id())));
                    }
                }
            }
            if (event.key == 'v' && this.ctrlDown) {
                if (this.clipboard.length == 0) return ;
                let root = this.clipboard[0];
                
                if (root.name.startsWith('rect primary')) {
                    if (!this.plot_canvas_mode) {
                        alert('Please select plot');
                        return ;
                    }
                    this.addRect(root.width, root.height, root.name, this.get_sub_type(root.id));
                }
                else if (root.name.startsWith('rect node')) {
                    if (!this.plot_canvas_mode || this.parent_node != this.plot) {
                        alert('Please select plot');
                        return ;
                    }
                    if (root.name.endsWith('building')) {
                        let new_root = this.addRect(root.width, root.height, root.name, this.get_sub_type(root.id));
                        
                        this.clipboard.slice(1).forEach(node => {
                            let id = node.id.split(root.id + '_')[1];
                            let tokens = id.split('_');
                            tokens.pop();
                            id = tokens.join('_');
                            let rect = this.addRect(node.width, node.height, node.name, new_root.id() + '_' + id, node.x + new_root.x(), node.y + new_root.y())
                            this.set_visible(rect, false);
                        });
                        this.buildings[this.buildings.length - 1].floors = this.clipboard_building.floors;
                        this.buildings[this.buildings.length - 1].roof_floor = this.clipboard_building.roof_floor;

                        this.deselect();
                        if (this.is_selectable) this.select(new_root);
                    }
                }
                else if (root.name.startsWith('rect room')) {
                    if (this.plot_canvas_mode) {
                        alert('Please paste on Floor canvas');
                        return ;
                    }
                    let id = root.id;
                    if (root.name.endsWith('normal')) {
                        id = `${this.parent_node.id()}_floor_${this.current_floor}_${this.get_sub_type(id)}`;
                    }
                    else {
                        id = `${this.parent_node.id()}_stack_${this.get_sub_type(id)}`;
                    }
                    this.addRect(root.width, root.height, root.name, id);
                }
            }
            if (this.ctrlDown && event.key == 'z') {
                this.undo_history();
            }
            if (this.ctrlDown && event.key == 'y') {
                this.redo_history();
            }
            if (event.key == "Escape") {
                if (this.fullscreenMode) {
                    this.toggle_fullscreen();
                    event.preventDefault();
                }
            }
        });

        $(document).keyup((event) => {
            if (event.key == ' ') {
                if (this.is_pannable) {
                    this.toggle_panning();
                }
            }
            if (event.key == 'Control') this.ctrlDown = false;
        });
    }
    set_layer_listeners() {
        this.layer.off('dragmove');
        this.layer.on('dragmove', (e) => {
            if (this.is_pannable) {
                e.evt.preventDefault();
                return;
            }
            // clear all previous lines on the screen
            this.layer.find('.guid-line').forEach((l) => l.destroy());

            // find possible snapping lines
            var lineGuideStops = this.getLineGuideStops(e.target);
            // find snapping points of current object
            var itemBounds = this.getObjectSnappingEdges(e.target);
            // now find where can we snap current object
            var guides = this.getGuides(lineGuideStops, itemBounds);
            // do nothing of no snapping
            if (!guides.length) {
                return;
            }

            this.drawGuides(guides);

            var absPos = {
                x: e.target.x(),
                y: e.target.y(),
                width: e.target.width(),
                height: e.target.height()
            };

            // now force object position
            guides.forEach((lg) => {
                switch (lg.snap) {
                    case 'start': {
                        switch (lg.orientation) {
                            case 'V': {
                                absPos.x = lg.lineGuide + lg.offset;
                                break;
                            }
                            case 'H': {
                                absPos.y = lg.lineGuide + lg.offset;
                                break;
                            }
                        }
                        break;
                    }
                    case 'center': {
                        switch (lg.orientation) {
                            case 'V': {
                                absPos.x = lg.lineGuide + lg.offset;
                                break;
                            }
                            case 'H': {
                                absPos.y = lg.lineGuide + lg.offset;
                                break;
                            }
                        }
                        break;
                    }
                    case 'end': {
                        switch (lg.orientation) {
                            case 'V': {
                                absPos.x = lg.lineGuide + lg.offset;
                                break;
                            }
                            case 'H': {
                                absPos.y = lg.lineGuide + lg.offset;
                                break;
                            }
                        }
                        break;
                    }
                }
            });
            let parent = this.get_parent_rect();
            let x = Math.min(parent.right - absPos.width, Math.max(parent.left, absPos.x));
            let y = Math.min(parent.bottom - absPos.height, Math.max(parent.top, absPos.y));
            this.change_position_in_hand(e.target, x, y);
            this.refresh_label(e.target);
            this.display_property(e.target);
        });
        this.layer.off('dragend');
        this.layer.on('dragend', (e) => {
            // clear all previous lines on the screen
            this.layer.find('.guid-line').forEach((l) => l.destroy());
        });
    }
    deselect() {
        if (this.selected) {
            this.selected.stroke('gray');
            this.selected.strokeWidth(0.5);
            this.selected = null;
        }
        this.set_parent(this.parent_node);
        this.tr.nodes([]);
    }
    select(node) {
        console.log('select', node);
        if (node && node.hasName('rect') && this.is_selectable) {
            this.deselect();
            node.stroke('rgb(63 244 94)');
            node.strokeWidth(2);
            if (this.is_movable) {
                // var nodes = [];
                // this.layer.find('.rect').filter((rect) => {
                //     if (node.hasName('plot') && (rect.hasName('node' || rect.hasName('room'))) || rect.id().startsWith(node.id())) nodes.push(rect);
                // });
                // this.tr.nodes(nodes);
                this.tr.nodes([node]);
            }
            this.display_property(node);
            this.selected = node;
            if (this.is_movable) this.stage.container().style.cursor = 'move';
        }
    }
    delete_one(node) {
        if (node.hasName('building')) {
            this.buildings = this.buildings.filter(building => building.id != node.id());
        }
        this.layer.find('#' + node.id() + '_label')[0].destroy();
        this.layer.find('#' + node.id() + '_area_label')[0].destroy();
        node.destroy();
    }
    delete_node() {
        if (this.selected) {
            this.get_children(this.selected).forEach(node => this.delete_one(node));
            this.delete_one(this.selected);
            this.selected = null;
            this.save_history();
        };
        this.tr.nodes([]);
    }
    on_width_change(e) {
        if (this.selected == null) return;
        let width = Math.max(1, Math.min(this.get_parent_rect().right - this.selected.x(), e.target.valueAsNumber));
        e.target.value = width.toFixed(this.POSITION_PRECISION);
        this.selected.setAttrs({
            width: width
        });
        this.refresh_label(this.selected);
        this.save_history();
    }
    on_height_change(e) {
        if (this.selected == null) return;
        let height = Math.max(1, Math.min(this.selected.height() + this.selected.y(), e.target.valueAsNumber));
        e.target.value = height.toFixed(this.POSITION_PRECISION);
        this.selected.setAttrs({
            height: height,
            y: this.selected.height() - height + this.selected.y()
        });
        this.refresh_label(this.selected);
        this.save_history();
    }
    on_x_pos_change(e) {
        if (this.selected == null) return;
        let x = Math.max(0, Math.min(this.width - this.selected.width(), e.target.valueAsNumber));
        e.target.value = x;
        this.save_current_position(this.selected);
        this.selected.setAttrs({
            x: x
        });
        this.change_position_in_hand(this.selected, x, this.selected.y());
        this.refresh_label(this.selected);
        this.save_history();
    }
    on_y_pos_change(e) {
        if (this.selected == null) return;
        let y = Math.max(0, Math.min(this.height - this.selected.height(), e.target.valueAsNumber));
        e.target.value = y;
        this.save_current_position(this.selected);
        this.selected.setAttrs({
            y: this.height - y - this.selected.height()
        });
        this.change_position_in_hand(this.selected, this.selected.x(), y);
        this.refresh_label(this.selected);
        this.save_history();
    }
    toggle_selectable(e) {
        this.deselect();
        this.is_selectable = this.is_selectable ? false : true;
        if (this.is_selectable) $(e.target).removeClass('text-neutral-500');
        else $(e.target).addClass('text-neutral-500');
    }
    toggle_panning(e) {
        this.is_pannable = this.is_pannable ? false : true;
        if (this.is_pannable) {
            this.layer.find('.rect').forEach(rect => {
                rect.listening(false);
            });
            this.btn_pan.addClass('bg-rose-500 text-white');
            this.stage.container().style.cursor = 'grab';
            this.tr.visible(false);
        } else {
            this.layer.find('.rect').forEach(rect => {
                rect.listening(true);
            });
            this.btn_pan.removeClass('bg-rose-500 text-white');
            this.stage.container().style.cursor = 'default';
            this.tr.visible(true);
        }
    }
    toggle_movable(e) {
        this.is_movable = this.is_movable ? false : true;
        if (this.is_movable) {
            this.layer.find('.rect').forEach(rect => {
                rect.draggable(true);
            });
            $(e.target).removeClass('text-neutral-500');
            if (this.selected) this.tr.nodes([this.selected]);
        } else {
            this.layer.find('.rect').forEach(rect => {
                rect.draggable(false);
            });
            $(e.target).addClass('text-neutral-500');
            this.tr.nodes([]);
        }
    }
    intersect(a, b) {
        return Math.max(a.x(), b.x()) + 1e-3 < Math.min(a.x() + a.width(), b.x() + b.width()) &&
        Math.max(a.y(), b.y()) + 1e-3 < Math.min(a.y() + a.height(), b.y() + b.height());
    }
    contains(a, b) {
        return b.x() + 1e-3 > a.x() && 
        b.x() + b.width() - 1e-3 < a.x() + a.width() &&
        b.y() + 1e-3 > a.y() &&
        b.y() + b.height() - 1e-3 < a.y() + a.height();
    }
    check_error() {
        this.has_error = true;
        this.error_text.removeClass('hidden');
        
        var shapes = this.layer.find('.primary');
        
        for (let i = 0; i < shapes.length; i++) {
            if (!shapes[i].visible()) continue;
            for (let j = i + 1; j < shapes.length; j++) {
                if (!shapes[j].visible()) continue;
                if (this.intersect(shapes[i], shapes[j])) return;
            }
        }
        var rooms = this.layer.find('.room');
        for (let i = 0; i < rooms.length; i++) {
            if (!rooms[i].visible()) continue;
            for (let j = i + 1; j < rooms.length; j++) {
                if (!rooms[j].visible()) continue;
                if (this.intersect(rooms[i], rooms[j])) return;
            }
        }
        shapes = this.layer.find('.node');
        for (let i = 0; i < shapes.length; i++) {
            if (!shapes[i].visible()) continue;
            if (this.plot) {
                if (!this.contains(this.plot, shapes[i])) return;
            }
            if (shapes[i].hasName('building')) {
                for (let j = 0; j < rooms.length; j++) {
                    if (!rooms[j].visible()) continue;
                    if (rooms[j].id().startsWith(shapes[i].id()) && !this.contains(shapes[i], rooms[j])) return;
                }
            }
            for (let j = i + 1; j < shapes.length; j++) {
                if (!shapes[j].visible()) continue;
                if (this.intersect(shapes[i], shapes[j])) return;
            }
        }
        this.has_error = false;
        this.error_text.addClass('hidden');
    }
    save_history() {
        this.appHistory = this.appHistory.slice(0, this.appHistoryStep + 1);
        var layer = this.layer.clone();
        layer.find('.guid-line').forEach(line => line.destroy());
        layer.find('.rect').forEach(rect => {
            rect.stroke('gray');
            rect.strokeWidth(0.5);
        })
        this.appHistory.push({
            layer,
            mode: this.plot_canvas_mode,
            parent_id: this.parent_node ? this.parent_node.id(): null,
            current_floor: this.current_floor,
            buildings: JSON.parse(JSON.stringify(this.buildings))
        });
        this.saveLocalStorage();
        this.appHistoryStep++;
        this.check_error();
        // console.log(this.appHistory);
    }
    undo_history() {
        if (this.appHistoryStep == 0) return;
        this.layer.destroy();
        this.trlayer.remove();
        let status = this.appHistory[this.appHistoryStep - 1];
        this.layer = status.layer.clone();
        this.on_mode_changed(status.mode);
        if (status.parent_id) this.set_parent_by_id(status.parent_id);
        this.current_floor = status.current_floor;
        this.plot = this.layer.find('.plot')[0];
        this.buildings = status.buildings;
        if (!this.plot_canvas_mode) this.on_select_building(this.buildings.findIndex(building => building.id == status.parent_id), this.current_floor);
        this.stage.add(this.layer);
        this.stage.add(this.trlayer);
        this.deselect();
        this.layer.find('.rect').forEach(rect => {
            rect.draggable(this.is_movable);
        });
        this.appHistoryStep--;
        this.saveLocalStorage();
        
        // console.log(this.appHistory[this.appHistoryStep]);
        this.check_error();
    }
    redo_history() {
        if (this.appHistoryStep == this.appHistory.length - 1) return;
        this.layer.destroy();
        this.trlayer.remove();
        let status = this.appHistory[this.appHistoryStep + 1];
        this.layer = status.layer.clone();
        this.on_mode_changed(status.mode);
        if (status.parent_id) this.set_parent_by_id(status.parent_id);
        this.current_floor = status.current_floor;
        this.plot = this.layer.find('.plot')[0];
        this.buildings = status.buildings;
        if (!this.plot_canvas_mode) this.on_select_building(this.buildings.findIndex(building => building.id == status.parent_id), this.current_floor);
        this.stage.add(this.layer);
        this.stage.add(this.trlayer);
        this.deselect();
        this.layer.find('.rect').forEach(rect => {
            rect.draggable(this.is_movable);
        });
        this.appHistoryStep++;
        this.saveLocalStorage();
        
        // console.log(this.appHistory[this.appHistoryStep]);
        this.check_error();
    }
    sketch_canvas_zoom(val) {
        var scale = this.sketch_canvas_scale = this.stage.scaleX();
        if (this.sketch_canvas_zoom_interval) clearInterval(this.sketch_canvas_zoom_interval);
        this.sketch_canvas_zoom_interval = setInterval(() => {
            this.sketch_canvas_scale += val * 0.05 * scale;
            this.sketch_canvas_scale = Math.max(this.sketch_canvas_scale, this.min_sketch_canvas_scale);
            this.setScale();
        }, 20);
    }

    setScale() {
        this.stage.scale({
            x: this.sketch_canvas_scale,
            y: this.sketch_canvas_scale
        });
        this.stage.setWidth(this.width * this.sketch_canvas_scale);
        this.stage.setHeight(this.height * this.sketch_canvas_scale);

        this.sketch_canvas.width(this.width * this.sketch_canvas_scale);
        this.sketch_canvas.height(this.height * this.sketch_canvas_scale);

        this.layer.find('.label').forEach((label) => {
            label.setAttrs({
                fontSize: this.get_fontSize('lg', label.width(), label.height())
            })
        })
        this.layer.find('.area_label').forEach((label) => {
            label.setAttrs({
                fontSize: this.get_fontSize('sm', label.width(), label.height())
            })
        })
    }

    sketch_canvas_zoom_stop() {
        if (this.sketch_canvas_zoom_interval) clearInterval(this.sketch_canvas_zoom_interval);
    }

    resize_sketch_canvas() {
        var v_width = this.sketch_canvas.parent().width() - 2 * parseFloat(this.sketch_canvas.css(
            'border-width'));
        var v_height = this.sketch_canvas.parent().height() - 2 * parseFloat(this.sketch_canvas.css(
            'border-width'));
        var width = this.width;
        var height = this.height;
        console.log('onresize', v_width, v_height);

        var pre_min_scale = this.min_sketch_canvas_scale;
        this.min_sketch_canvas_scale = Math.min(v_width / width, v_height / height);
        // this.sketch_canvas_scale *= this.min_sketch_canvas_scale / pre_min_scale;
        // if (this.sketch_canvas_scale < this.min_sketch_canvas_scale) 
        this.sketch_canvas_scale = this.min_sketch_canvas_scale;

        this.setScale();
        if (!this.fullscreenMode) this.sketch_canvas.parent().css('max-height', this.sketch_canvas.parent().outerHeight());
    }

    toggle_fullscreen() {
        if (!this.fullscreenMode) {
            $('#fullscreen').append(this.canvas_panel);
            $('#fullscreen').removeClass('hidden');
            this.fullscreenMode = true;
            this.sketch_canvas.parent().css('max-height', 999999);
            this.resize_sketch_canvas();
        } else {
            this.parent_sketch_canvas_panel.append(this.canvas_panel);
            this.fullscreenMode = false;
            this.resize_sketch_canvas();
            $('#fullscreen').addClass('hidden');
        }
    }

    display_property(node) {
        // console.log(node);
        if (node === this.stage) {
            this.x_pos_input.val(0);
            this.y_pos_input.val(0);
            this.width_input.val(0);
            this.height_input.val(0);
        } else {
            var x = parseFloat(node.x().toFixed(this.POSITION_PRECISION));
            var y = parseFloat(node.y().toFixed(this.POSITION_PRECISION));
            var h = parseFloat(node.height().toFixed(this.POSITION_PRECISION));
            var w = parseFloat(node.width().toFixed(this.POSITION_PRECISION));
            node.x(x);
            node.y(y);
            node.height(h);
            node.width(w);
            this.x_pos_input.val(node.x());
            this.y_pos_input.val((this.height - node.y() - node.height()).toFixed(this.POSITION_PRECISION));
            this.width_input.val(node.width());
            this.height_input.val(node.height());
        }
    }
    // were can we snap our objects?
    getLineGuideStops(skipShape) {
        if (this.parent_node == null) {
            // we can snap to stage borders and the center of the stage
            var vertical = [];
            var horizontal = [];

            // and we snap over edges and center of each object on the canvas
            this.layer.find('.primary').forEach((guideItem) => {
                if (guideItem === skipShape) {
                    return;
                }
                var box = guideItem.attrs; //getClientRect();
                // and we can snap to all edges of shapes
                vertical.push([box.x, box.x + box.width, box.x + box.width / 2]);
                horizontal.push([box.y, box.y + box.height, box.y + box.height / 2]);
            });
            return {
                vertical: vertical.flat(),
                horizontal: horizontal.flat(),
            };
        }
        else {
            var vertical = [this.parent_node.x(), this.parent_node.x() + this.parent_node.width() / 2, this.parent_node.x() + this.parent_node.width()];
            var horizontal = [this.parent_node.y(), this.parent_node.y() + this.parent_node.height() / 2, this.parent_node.y() + this.parent_node.height()];

            this.layer.find(this.plot_canvas_mode ? '.node' : '.room').forEach((guideItem) => {
                if (guideItem === skipShape || !guideItem.visible()) {
                    return;
                }
                var box = guideItem.attrs; //getClientRect();
                // and we can snap to all edges of shapes
                vertical.push([box.x, box.x + box.width, box.x + box.width / 2]);
                horizontal.push([box.y, box.y + box.height, box.y + box.height / 2]);
            });
            return {
                vertical: vertical.flat(),
                horizontal: horizontal.flat(),
            };
        }
    }

    // what points of the object will trigger to snapping?
    // it can be just center of the object
    // but we will enable all edges and center
    getObjectSnappingEdges(node) {
        var box = node.attrs; //getClientRect();
        var absPos = node.absolutePosition();

        return {
            vertical: [{
                guide: box.x,
                offset: 0, //Math.round(absPos.x - box.x),
                snap: 'start',
            }, {
                guide: box.x + box.width / 2,
                offset: -box.width / 2, //Math.round(absPos.x - box.x - box.width / 2),
                snap: 'center',
            }, {
                guide: box.x + box.width,
                offset: -box.width, //Math.round(absPos.x - box.x - box.width),
                snap: 'end',
            }, ],
            horizontal: [{
                guide: box.y,
                offset: 0, //Math.round(absPos.y - box.y),
                snap: 'start',
            }, {
                guide: box.y + box.height / 2,
                offset: -box.height / 2, //Math.round(absPos.y - box.y - box.height / 2),
                snap: 'center',
            }, {
                guide: box.y + box.height,
                offset: -box.height, //Math.round(absPos.y - box.y - box.height),
                snap: 'end',
            }, ],
        };
    }

    // find all snapping possibilities
    getGuides(lineGuideStops, itemBounds) {
        var resultV = [];
        var resultH = [];

        lineGuideStops.vertical.forEach((lineGuide) => {
            itemBounds.vertical.forEach((itemBound) => {
                var diff = lineGuide - itemBound.guide;
                // if the distance between guild line and object snap point is close we can consider this for snapping
                if (Math.abs(diff) < this.GUIDELINE_OFFSET / this.sketch_canvas_scale) {
                    resultV.push({
                        lineGuide: lineGuide,
                        diff: diff,
                        snap: itemBound.snap,
                        offset: itemBound.offset,
                    });
                }
            });
        });

        lineGuideStops.horizontal.forEach((lineGuide) => {
            itemBounds.horizontal.forEach((itemBound) => {
                var diff = lineGuide - itemBound.guide;
                if (Math.abs(diff) < this.GUIDELINE_OFFSET / this.sketch_canvas_scale) {
                    resultH.push({
                        lineGuide: lineGuide,
                        diff: diff,
                        snap: itemBound.snap,
                        offset: itemBound.offset,
                    });
                }
            });
        });

        var guides = [];

        // find closest snap
        var minV = resultV.sort((a, b) => a.diff - b.diff)[0];
        var minH = resultH.sort((a, b) => a.diff - b.diff)[0];
        if (minV) {
            guides.push({
                lineGuide: minV.lineGuide,
                offset: minV.offset,
                orientation: 'V',
                snap: minV.snap,
                diff: minV.diff,
            });
        }
        if (minH) {
            guides.push({
                lineGuide: minH.lineGuide,
                offset: minH.offset,
                orientation: 'H',
                snap: minH.snap,
                diff: minH.diff,
            });
        }
        return guides;
    }

    drawGuides(guides) {
        guides.forEach((lg) => {
            if (lg.orientation === 'H') {
                var line = new Konva.Line({
                    points: [-6000, 0, 6000, 0],
                    stroke: 'rgb(0, 161, 255)',
                    strokeWidth: 1 / this.sketch_canvas_scale,
                    name: 'guid-line',
                    // dash: [4, 6],
                });
                this.layer.add(line);
                line.setAttrs({
                    x: 0,
                    y: lg.lineGuide,
                });
            } else if (lg.orientation === 'V') {
                var line = new Konva.Line({
                    points: [0, -6000, 0, 6000],
                    stroke: 'rgb(0, 161, 255)',
                    strokeWidth: 1 / this.sketch_canvas_scale,
                    name: 'guid-line',
                    // dash: [4, 6],
                });
                this.layer.add(line);
                line.setAttrs({
                    x: lg.lineGuide,
                    y: 0,
                });
            }
        });
    }
    
    get_width() {
        if (this.parent_node) return this.parent_node.width();
        return this.width;
    }
    get_height() {
        if (this.parent_node) return this.parent_node.height();
        return this.height;
    }
    get_parent_rect() {
        if (this.parent_node) return {
            left : this.parent_node.x(),
            top : this.parent_node.y(),
            right: this.parent_node.x() + this.parent_node.width(),
            bottom: this.parent_node.y() + this.parent_node.height()
        }
        return {
            left: 0,
            right: this.width,
            top: 0,
            bottom: this.height
        }
    }
    update_children_position(node, dx, dy) {
        this.layer.find('.rect').filter((rect) => {
            if (rect !== node && (rect.id().startsWith(node.id()) || node.hasName('plot') && rect.hasName('node'))) {
                rect.setAttrs({
                    x: rect.x() + dx,
                    y: rect.y() + dy
                });
                this.refresh_label(rect);
            }
        });
    }
    get_children(node) {
        return this.layer.find('.rect').filter((rect) => {
            if (rect === node) return false;
            if (node.hasName('plot')) return rect.hasName('node') || rect.hasName('room');
            return rect.id().startsWith(node.id());
        });
    }
    // get_labels(node) {
    //     return [
    //         ...this.layer.find(`#${node.id()}_label`),
    //         ...this.layer.find(`#${node.id()}_area_label`)
    //     ];
    // }
    save_current_position(node) {
        this.startPos = {
            x: node.x(),
            y: node.y()
        }
        this.nodes_in_hand = this.get_children(node).map((child) => {
            return {
                child,
                startPos: {
                    x: child.x(),
                    y: child.y()
                }
            }
        })
    }
    change_position_in_hand(rect, x, y) {
        rect.setAttrs({ x, y });
        this.nodes_in_hand.forEach((node) => {
            node.child.setAttrs({
                x: node.startPos.x + x - this.startPos.x,
                y: node.startPos.y + y - this.startPos.y
            });
            this.refresh_label(node.child);
        });
    }
    set_listeners(rect) {
        rect.off('mouseenter');
        rect.on('mouseenter', (e) => {
            if (!this.is_pannable && this.is_selectable && this.is_movable && e.target === this
                .selected) this.stage.container().style.cursor = 'move';
        });
        rect.off('moutseleave');
        rect.on('mouseleave', () => {
            if (!this.is_pannable) this.stage.container().style.cursor = 'default';
        });
        rect.off('transform');
        rect.on('transform', (e) => {
            var rect = e.target;
            if (this.plot_canvas_mode) {
                if (e.target.hasName('primary')) {
                    this.set_parent(null);
                }
                else this.set_parent(this.plot);
            }
            var parent = this.get_parent_rect();
            var x1 = Math.min(Math.max(rect.x(), parent.left), parent.right- 1);
            var x2 = Math.max(1, Math.min(parent.right, rect.x() + Math.max(rect.width() * rect.scaleX(), 1)));
            var y1 = Math.min(Math.max(rect.y(), parent.top), parent.bottom - 1);
            var y2 = Math.max(1, Math.min(parent.bottom, rect.y() + Math.max(rect.height() * rect
                .scaleY(), 1)));
                
            rect.setAttrs({
                width: x2 - x1,
                height: y2 - y1,
                x: x1,
                y: y1,
                scaleX: 1,
                scaleY: 1,
            });
            
            this.display_property(rect);
            this.refresh_label(rect);
        });
        rect.off('transformend');
        rect.on('transformend', (e) => {
            var rect = e.target;
            this.refresh_label(rect);
            this.save_history();
        });
        rect.off('dragstart');
        rect.on('dragstart', (e) => {
            this.save_current_position(e.target);
        });
        rect.off('dragmove');
        rect.on('dragmove', (e) => {
            let rect = e.target;
            let parent = this.get_parent_rect();
            let x = Math.min(Math.max(parent.left, rect.x()), parent.right - rect.width());
            let y = Math.min(Math.max(parent.top, rect.y()), parent.bottom - rect.height());
            this.change_position_in_hand(rect, x, y);
            this.display_property(rect);
            this.refresh_label(rect);
        });
        rect.off('dragend');
        rect.on('dragend', (e) => {
            let rect = e.target;
            let parent = this.get_parent_rect();
            let x = Math.min(Math.max(parent.left, rect.x()), parent.right - rect.width());
            let y = Math.min(Math.max(parent.top, rect.y()), parent.bottom - rect.height());
            this.change_position_in_hand(rect, x, y);
            this.nodes_in_hand = [];
            this.refresh_label(rect);
            this.display_property(rect);
            this.save_history();
        });
    }
    get_adding_point(width, height) {
        if (this.parent_node) {
            return {
                x: this.parent_node.x() + this.parent_node.width() / 2,
                y: this.parent_node.y() + this.parent_node.height() / 2
            }
        }
        return {
            x: this.width / 2,
            y: this.height / 2
        }
    }
    addRect(width, height, name, id, x = null, y = null) {
        if (name == 'floor') {
            var rect = new Konva.Rect({
                x: 0,
                y: 0,
                width,
                height,
                name,
                id,
                visible: false,
                listening: false
            });
            this.layer.add(rect);
            this.save_history();
            return ;
        }
        id = id.split(' ').join('[space]');
        if (x == null) {
            let p = this.get_adding_point(width, height);
            x = p.x;
            y = p.y;

            x -= width / 2;
            y -= height / 2;
        }
        
        var rect = new Konva.Rect({
            x,
            y,
            width: width,
            height: height,
            fill: 'rgb(' + parseInt(200 + Math.random() * 50) + ', ' + parseInt(200 + Math.random() * 50) + ', ' + parseInt(200 + Math.random() * 50) + ', 0.9)',
            name,
            stroke: 'gray',
            strokeWidth: 0.5 / this.sketch_canvas_scale,
            strokeScaleEnabled: false,
            draggable: true,
            id: id
        });
        if (rect.hasName('plot')) {
            this.plot = rect;
            rect.fill('rgb(250, 250, 250)');
        }

        var text = id.split('_').pop() + '_' + rect._id;
        text = text.split('[space]').join(' ');
        rect.id(id + '_' + rect._id);
        
        if (rect.hasName('stack')) name = ' stack';
        else name = '';

        var label = new Konva.Text({
            id: rect.id() + '_label',
            text: text + '\n',
            name: 'label' + name,
            fontSize: this.get_fontSize('lg', width, height),
            lineHeight: 1.2,
            padding: 0,
            fill: 'black',
            x,
            y,
            width,
            height,
            align: 'center',
            verticalAlign: 'middle',
            listening: false,
        });

        var area_label = new Konva.Text({
            id: rect.id() + '_area_label',
            text: '\n' + (width * height).toFixed(this.AREA_PRECISION) + ' ㎡',
            name: 'area_label' + name,
            fontSize: this.get_fontSize('sm', width, height),
            lineHeight: 1.2,
            padding: 0,
            fill: 'black',
            x,
            y,
            width,
            height,
            align: 'center',
            verticalAlign: 'middle',
            listening: false,
        });
        this.layer.add(rect);
        this.layer.add(label);
        this.layer.add(area_label);

        if (rect.hasName('building')) {
            this.buildings.push({
                id: rect.id(),
                text,
                floors: [],
                roof_floor: -1,
            })
        }
        
        this.set_listeners(rect);
        this.select(rect);
        this.save_history();

        // if (this.plot == rect) {
        //     this.sketch_canvas_scale = this.min_sketch_canvas_scale = Math.max(this.min_sketch_canvas_scale, Math.min(this.width / width, this.height / height) / 2);
        //     this.setScale();
        //     this.sketch_pan.scrollLeft(0);
        //     this.sketch_pan.scrollTop(999999999);
        // }
        return rect;
    }

    get_area(rect) {
        return (rect.width() * rect.height()).toFixed(this.AREA_PRECISION);
    }
    refresh_label(rect) {
        this.layer.find('#' + rect.id() + '_label').forEach((label) => label.setAttrs({
            x: rect.x(),
            y: rect.y(),
            width: rect.width(),
            height: rect.height(),
            fontSize: this.get_fontSize('lg', rect.width(), rect.height())
        }));
        this.layer.find('#' + rect.id() + '_area_label').forEach((label) => label.setAttrs({
            x: rect.x(),
            y: rect.y(),
            width: rect.width(),
            height: rect.height(),
            text: '\n' + this.get_area(rect) + ' ㎡',
            fontSize: this.get_fontSize('sm', rect.width(), rect.height())
        }));
    }

    get_fontSize(sz, rect_width = this.width, rect_height = this.height) {
        var size = 11;
        if (sz == 'lg') size = 16;
        if (sz == 'md') size = 13;
        // return size;
        return size * Math.min(Math.min(this.width / 75 / this.sketch_canvas_scale, rect_width / 130), rect_height / 50);
    }

    get_ext_points(node) {
        return [
            [node.x(), node.y()],
            [node.x() + node.width(), node.y()],
            [node.x() + node.width(), node.y() + node.height()],
            [node.x(), node.y() + node.height()],
        ]
    }

    get_sub_type(node) {
        if (typeof node != 'string') return this.get_sub_type(node.id());
        var tokens = node.split('_');
        tokens.pop();
        return tokens.pop().split('[space]').join(' ');
    }

    get_label(node) {
        return this.layer.find('#' + node.id() + '_label')[0].text();
    }

    get_node_by_id(id) {
        var result = this.layer.find('#' + id);
        if (result.length > 0) return result[0];
        return null;
    }

    createSvg(node) {
        
        const centerX = node.x() + node.width() / 2;
        const centerY = node.y() + node.height() / 2;
        const label = this.get_label(node);

        const svgContent = `<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">`+
        `<rect x="${node.x()}" y="${node.y()}" width="${node.width()}" height="${node.height()}" fill="${node.fill()}"/>`+
        `<text x="${centerX}" y="${centerY}" dominant-baseline="middle" text-anchor="middle" fill="black" font-size="12">${label}</text>` +
        `</svg>`;
      
        return svgContent;
    }
}