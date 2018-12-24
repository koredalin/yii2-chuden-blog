<?php

use yii\db\Schema;
use app\migrations\Migration;

class m181224_100113_chuden_blog extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%blog_category}}',[
            'id'=> $this->primaryKey(8)->unsigned(),
            'name'=> $this->string(255)->notNull(),
            'parent_id'=> $this->integer(8)->unsigned()->null()->defaultValue(null),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('name','{{%blog_category}}',['name'],true);
        $this->createIndex('parent_id','{{%blog_category}}',['parent_id'],false);

        $this->createTable('{{%blog_comment}}',[
            'id'=> $this->bigPrimaryKey(20)->unsigned(),
            'content'=> $this->text()->notNull(),
            'user_id'=> $this->integer(11)->notNull(),
            'blog_post_id'=> $this->integer(10)->unsigned()->notNull(),
            'parent_id'=> $this->bigInteger(20)->unsigned()->null()->defaultValue(null),
            'rating'=> $this->decimal(3, 2)->null()->defaultValue(null),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('blog_post_id','{{%blog_comment}}',['blog_post_id'],false);
        $this->createIndex('user_id','{{%blog_comment}}',['user_id'],false);
        $this->createIndex('parent_id','{{%blog_comment}}',['parent_id'],false);

        $this->createTable('{{%blog_comment_rating}}',[
            'id'=> $this->bigPrimaryKey(20),
            'blog_comment_id'=> $this->bigInteger(20)->unsigned()->notNull(),
            'user_id'=> $this->integer(11)->notNull(),
            'rating'=> $this->decimal(2, 1)->notNull()->defaultValue('1.0'),
        ], $tableOptions);

        $this->createIndex('user_id','{{%blog_comment_rating}}',['user_id'],false);
        $this->createIndex('blog_comment_id','{{%blog_comment_rating}}',['blog_comment_id'],false);

        $this->createTable('{{%blog_post}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'published'=> $this->tinyint(4)->unsigned()->notNull()->defaultValue(0),
            'language'=> "enum('en-GB', 'bg-BG') NOT NULL",
            'slug'=> $this->string(120)->notNull(),
            'title'=> $this->string(100)->notNull(),
            'meta_description'=> $this->string(230)->notNull(),
            'blog_category_id'=> $this->integer(8)->unsigned()->notNull(),
            'tags'=> $this->string(255)->null()->defaultValue(null),
            'content'=> $this->text()->notNull(),
            'rating'=> $this->decimal(3, 2)->null()->defaultValue(null),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('title','{{%blog_post}}',['title'],true);
        $this->createIndex('meta_description','{{%blog_post}}',['meta_description'],true);
        $this->createIndex('slug_2','{{%blog_post}}',['slug'],true);
        $this->createIndex('slug','{{%blog_post}}',['slug'],false);
        $this->createIndex('blog_category_id','{{%blog_post}}',['blog_category_id'],false);

        $this->createTable('{{%blog_post_rating}}',[
            'id'=> $this->bigPrimaryKey(20)->unsigned(),
            'blog_post_id'=> $this->integer(10)->unsigned()->notNull(),
            'user_id'=> $this->integer(11)->notNull(),
            'rating'=> $this->decimal(2, 1)->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id','{{%blog_post_rating}}',['user_id'],false);
        $this->createIndex('blog_post_id','{{%blog_post_rating}}',['blog_post_id'],false);
        $this->addForeignKey(
            'fk_blog_category_parent_id',
            '{{%blog_category}}', 'parent_id',
            '{{%blog_category}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_parent_id',
            '{{%blog_comment}}', 'parent_id',
            '{{%blog_comment}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_blog_post_id',
            '{{%blog_comment}}', 'blog_post_id',
            '{{%blog_post}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_user_id',
            '{{%blog_comment}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_rating_blog_comment_id',
            '{{%blog_comment_rating}}', 'blog_comment_id',
            '{{%blog_comment}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_rating_user_id',
            '{{%blog_comment_rating}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_post_blog_category_id',
            '{{%blog_post}}', 'blog_category_id',
            '{{%blog_category}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_post_rating_blog_post_id',
            '{{%blog_post_rating}}', 'blog_post_id',
            '{{%blog_post}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_post_rating_user_id',
            '{{%blog_post_rating}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'NO ACTION'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_blog_category_parent_id', '{{%blog_category}}');
            $this->dropForeignKey('fk_blog_comment_parent_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_blog_post_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_user_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_rating_blog_comment_id', '{{%blog_comment_rating}}');
            $this->dropForeignKey('fk_blog_comment_rating_user_id', '{{%blog_comment_rating}}');
            $this->dropForeignKey('fk_blog_post_blog_category_id', '{{%blog_post}}');
            $this->dropForeignKey('fk_blog_post_rating_blog_post_id', '{{%blog_post_rating}}');
            $this->dropForeignKey('fk_blog_post_rating_user_id', '{{%blog_post_rating}}');
            $this->dropTable('{{%blog_category}}');
            $this->dropTable('{{%blog_comment}}');
            $this->dropTable('{{%blog_comment_rating}}');
            $this->dropTable('{{%blog_post}}');
            $this->dropTable('{{%blog_post_rating}}');
    }
}
