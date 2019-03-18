# Getting started with Yii2-chuden-blog

Yii2-chuden-blog is Yii2 simple template blog which will be made as Yii2 extension in future. It uses https://github.com/dektrium/yii2-user.

Please, use PHP5.6 or PHP7.0 and MySql database server.
A simple way for starting the blog is with an XAMPP.

### 1. Download

Yii2-chuden-blog can be installed using composer. Run following command to download and
install Yii2-chuden-blog:

```bash
https://github.com/koredalin/yii2-chuden-blog.git
```

### 2. Configure

> **NOTE:** Please, install the blog with default config.php file.
After you start the blog - you can update it at any time.

### 3. Update database schema

The last thing you need to do is updating your database schema by applying the
migrations. Please, make an empty database with name "chuden-blog" with a collation: "utf8_general_ci" (for preference). Make sure that you have properly configured `db` application component
and run the following command:

```bash
# Please, install Dektrium user tables first.
$ php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
# Please, install Chuden blog tables after that.
$ php yii migrate/up --migrationPath=@app/migrations
```

## Start on: http://localhost/chuden-blog/web/index.php