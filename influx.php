<?php
/**
 * @package Inflex
 * @version 1.0
 */
/*
Plugin Name: Inflex
Plugin URI: http://example.com
Description: This is default setting plugin, For myself( ryu saiwai )
Author: Ryu Saiwai
Version: 1.0
Author URI: http://ma.tt/
*/
$influxPlugin = new Plugin_Influx();

/**
 * プラグイン本体
 *
 */
class Plugin_Influx
{
    /**
     * コンストラクタ
     *
     * ウィジェットの初期化、WPフック・ショートタグなどの登録を行う。
     */
    public function __construct()
    {
        // プラグインが有効化されたときに実行されるメソッドを登録
        if (function_exists('register_activation_hook'))
        {
            register_activation_hook(__FILE__, array(&$this, 'activationHook'));
        }

        // プラグインが停止されたときに実行されるメソッドを登録
        if (function_exists('register_deactivation_hook'))
        {
            register_deactivation_hook(__FILE__, array(&$this, 'deactivationHook'));
        }

        // プラグインがアンインストールされたときに実行されるメソッドを登録
        if (function_exists('register_uninstall_hook'))
        {
            register_uninstall_hook(__FILE__, array(&$this, 'uninstallHook'));
        }

        // ウィジェットの初期化
        $this->initWidgets();

        // アクションフックの設定
        add_action('init', array(&$this, 'initActionHook'));

        // フィルターフックの設定
        add_filter('the_content', array(&$this, 'theContentFilterHook'));

        // ショートコードの設定
        add_shortcode('sample', array(&$this, 'sampleShortCode'));
    }


    /**
     * プラグインが有効化されたときに実行されるメソッド
     *
     * @return void
     */
    public function activationHook()
    {
        // 初回有効時のみ、初期化処理を行いたい場合は、オプション値にフラグをセットするなどすればよい
        if (! get_option('hello_world_plugin_installed'))
        {
            // オプション値の登録など・・・

            // インストール済みフラグをセット
            update_option('hello_world_plugin_installed', 1);
        }
    }

    /**
     * プラグインが停止されたときに実行されるメソッドx
     *
     * @return void
     */
    public function deactivationHook()
    {
        // プラグインが停止されたときの処理・・・
    }

    /**
     * プラグインが削除(アンインストール)されたときに実行されるメソッド
     *
     * unisntall.phpがある場合、unisntall.phpが優先的に実行されるので注意
     *
     * @return void
     */
    public function uninstallHook()
    {
        // オプション値の削除など・・・

        // インストール済みフラグを削除する
        delete_option('hello_world_plugin_installed');
    }

    /**
     * ウィジェットの登録
     *
     * @return void
     */
    public function initWidgets()
    {
        // ウィジェットの登録・・・
        // require_once __DIR__ . '/widgets/Sample.php';
        // add_action('widgets_init', create_function('', 'return register_widget("My_Widget_Sample");'));
    }

    /**
     * initアクションフック
     *
     * @return void
     */
    public function initActionHook()
    {
        // initアクションの処理・・・
    }

    /**
     * the_contentフィルターフック
     *
     *
     * @param string $content 変更前のコンテンツ
     * @return string 変更後のコンテンツ
     */
    public function theContentFilterHook($content)
    {
        // the_contentフィルターフックの処理・・・
        return $content;
    }

    /**
     * ショートコードの定義
     *
     * @param array $atts ショートコードの属性
     */
    public function influxShortCode($atts)
    {
        extract(shortcode_atts(array(
            'foo' => 'something',
            'bar' => 'something else',
        ), $atts));

        // ショートタグの処理・・・

        return sprintf('foo = %s, bar = %s', $foo, $bar);
    }

}
?>