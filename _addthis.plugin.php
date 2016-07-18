<?php 

class addthis_plugin extends Plugin
{
	/**
	 * Variables below MUST be overriden by plugin implementations,
	 * either in the subclass declaration or in the subclass constructor.
	 */

	var $name = 'addthis';
	var $code = 'evo_addthis';
	var $priority = 50;
	var $version = '1.5';
	var $author = 'The b2evo Group';
	var $group = 'rendering';
    var $number_of_installs = 1;


	/**
	 * Init
	 */
	function PluginInit( & $params )
	{
		$this->name = T_( 'AddThis' );
		$this->short_desc = T_('Share contents to your favorite social networks using the AddThis sharing service.');
		$this->long_desc = T_('Let your visitors share your content to their preferred social networks using the AddThis sharing service.');
	}


	function get_coll_setting_definitions( & $params )
	{
		$default_params = array_merge( $params, array(
				'default_post_rendering' => 'opt-out'
			) );

		$plugin_settings = array(
							'addthis_enabled' => array(
									'label' => T_('Enabled'),
									'type' => 'checkbox',
									'note' => 'Is the plugin enabled for this collection?',
								),

                            'addthis_publisher_id' => array(
                                'label' => T_('Addthis PubID'),
                                'size' => 70,
                                'defaultvalue' => '',
                                'note' => T_('The ID that you get from your social sharing service.'),
                            ),
                        );

		return array_merge( $plugin_settings, parent::get_coll_setting_definitions( $default_params ) );
			
	}


	function SkinBeginHtmlHead( & $params )
	{
        global $Blog;

        if( $this->get_coll_setting( 'addthis_enabled', $Blog ) ) {
            require_js( '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $this->get_coll_setting( 'addthis_publisher_id', $Blog ), 'rsc_url', true );
        }
	}


	function RenderItemAsHtml( & $params )
	{
        if( $this->get_coll_setting( 'addthis_enabled', $Blog ) ) {
            $content = & $params['data'];

            $content .=  "\n"
                .'<!-- Go to www.addthis.com/dashboard to customize your tools -->' . "\n"
                .'<div class="addthis_sharing_toolbox"></div>' . "\n";
        }
	}
}