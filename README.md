# Buildings Trees - Staging Repository
This is the staging repository for the vergecad project. 
Deployed under domain: [vergecad.info](https://vergecad.info)

## Contributing
Make development changes on a feature branch. When ready, create a pull request to merge the feature branch into the main branch. 
### example
```bash
git checkout -b feature/feature-name
# make changes
git add .
git commit -m "commit message"
git push origin feature/feature-name
```
Then create a pull request on github to merge the feature branch into the main branch.

P.S.: direct commits to the main branch are also allowed but not recommended.

## Deployment
The following commands will execute automatically on the server after a push to the main branch:
```bash
git pull
/opt/cpanel/composer/bin/composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
php artisan config:clear
php artisan cache:clear
php artisan key:generate
php artisan migrate --force
```

P.S.: if you need to make changes to the deployment process e.g. add a new command or change an existing command, you can do so by editing the file: .github/workflows/deploy.yml or just open an issue and I will make the changes for you. 