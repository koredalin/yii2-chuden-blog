<?php

use yii\db\Schema;
use app\migrations\Migration;

class m190121_165914_chuden_blog extends Migration
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
            'reply_to_id'=> $this->bigInteger(20)->unsigned()->null()->defaultValue(null),
            'likes'=> $this->integer(8)->unsigned()->notNull()->defaultValue('0'),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('blog_post_id','{{%blog_comment}}',['blog_post_id'],false);
        $this->createIndex('user_id','{{%blog_comment}}',['user_id'],false);
        $this->createIndex('parent_id','{{%blog_comment}}',['parent_id'],false);
        $this->createIndex('reply_to_id','{{%blog_comment}}',['reply_to_id'],false);

        $this->createTable('{{%blog_comment_like}}',[
            'id'=> $this->bigPrimaryKey(20),
            'user_id'=> $this->integer(11)->notNull(),
            'blog_comment_id'=> $this->bigInteger(20)->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id_2','{{%blog_comment_like}}',['user_id','blog_comment_id'],true);
        $this->createIndex('user_id','{{%blog_comment_like}}',['user_id'],false);
        $this->createIndex('blog_comment_id','{{%blog_comment_like}}',['blog_comment_id'],false);

        $this->createTable('{{%blog_post}}',[
            'id'=> $this->primaryKey(10)->unsigned(),
            'published'=> $this->tinyint(4)->unsigned()->notNull()->defaultValue(0),
            'language_id'=> $this->integer(11)->notNull(),
            'slug'=> $this->string(120)->notNull(),
            'title'=> $this->string(100)->notNull(),
            'meta_description'=> $this->string(230)->notNull(),
            'blog_category_id'=> $this->integer(8)->unsigned()->notNull(),
            'tags'=> $this->string(255)->null()->defaultValue(null),
            'type'=> "enum('content', 'audio', 'video') NOT NULL DEFAULT 'content'",
            'podcast_url'=> $this->string(300)->null()->defaultValue(null),
            'content'=> $this->text()->null()->defaultValue(null),
            'rating'=> $this->decimal(3, 2)->null()->defaultValue(null),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('title','{{%blog_post}}',['title'],true);
        $this->createIndex('meta_description','{{%blog_post}}',['meta_description'],true);
        $this->createIndex('slug_2','{{%blog_post}}',['slug'],true);
        $this->createIndex('slug','{{%blog_post}}',['slug'],false);
        $this->createIndex('blog_category_id','{{%blog_post}}',['blog_category_id'],false);
        $this->createIndex('language_id','{{%blog_post}}',['language_id'],false);

        $this->createTable('{{%blog_post_rating}}',[
            'id'=> $this->bigPrimaryKey(20)->unsigned(),
            'user_id'=> $this->integer(11)->notNull(),
            'blog_post_id'=> $this->integer(10)->unsigned()->notNull(),
            'rating'=> $this->tinyint(4)->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id_2','{{%blog_post_rating}}',['user_id','blog_post_id'],true);
        $this->createIndex('user_id','{{%blog_post_rating}}',['user_id'],false);
        $this->createIndex('blog_post_id','{{%blog_post_rating}}',['blog_post_id'],false);

        $this->createTable('{{%blog_subscription}}',[
            'id'=> $this->bigPrimaryKey(20)->unsigned(),
            'user_id'=> $this->integer(11)->notNull(),
            'language_id'=> $this->integer(11)->notNull(),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('user_id','{{%blog_subscription}}',['user_id'],false);
        $this->createIndex('language_id','{{%blog_subscription}}',['language_id'],false);

        $this->createTable('{{%language}}',[
            'id'=> $this->primaryKey(11),
            'code'=> $this->string(20)->notNull(),
            'name'=> $this->string(200)->notNull(),
            'local_name'=> $this->string(200)->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_blog_category_parent_id',
            '{{%blog_category}}', 'parent_id',
            '{{%blog_category}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_blog_post_id',
            '{{%blog_comment}}', 'blog_post_id',
            '{{%blog_post}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_parent_id',
            '{{%blog_comment}}', 'parent_id',
            '{{%blog_comment}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_user_id',
            '{{%blog_comment}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_reply_to_id',
            '{{%blog_comment}}', 'reply_to_id',
            '{{%blog_comment}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_like_blog_comment_id',
            '{{%blog_comment_like}}', 'blog_comment_id',
            '{{%blog_comment}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_comment_like_user_id',
            '{{%blog_comment_like}}', 'user_id',
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
            'fk_blog_post_language_id',
            '{{%blog_post}}', 'language_id',
            '{{%language}}', 'id',
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
        $this->addForeignKey(
            'fk_blog_subscription_language_id',
            '{{%blog_subscription}}', 'language_id',
            '{{%language}}', 'id',
            'CASCADE', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_blog_subscription_user_id',
            '{{%blog_subscription}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'NO ACTION'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_blog_category_parent_id', '{{%blog_category}}');
            $this->dropForeignKey('fk_blog_comment_blog_post_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_parent_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_user_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_reply_to_id', '{{%blog_comment}}');
            $this->dropForeignKey('fk_blog_comment_like_blog_comment_id', '{{%blog_comment_like}}');
            $this->dropForeignKey('fk_blog_comment_like_user_id', '{{%blog_comment_like}}');
            $this->dropForeignKey('fk_blog_post_blog_category_id', '{{%blog_post}}');
            $this->dropForeignKey('fk_blog_post_language_id', '{{%blog_post}}');
            $this->dropForeignKey('fk_blog_post_rating_blog_post_id', '{{%blog_post_rating}}');
            $this->dropForeignKey('fk_blog_post_rating_user_id', '{{%blog_post_rating}}');
            $this->dropForeignKey('fk_blog_subscription_language_id', '{{%blog_subscription}}');
            $this->dropForeignKey('fk_blog_subscription_user_id', '{{%blog_subscription}}');
            $this->dropTable('{{%blog_category}}');
            $this->dropTable('{{%blog_comment}}');
            $this->dropTable('{{%blog_comment_like}}');
            $this->dropTable('{{%blog_post}}');
            $this->dropTable('{{%blog_post_rating}}');
            $this->dropTable('{{%blog_subscription}}');
            $this->dropTable('{{%language}}');
    }
}
