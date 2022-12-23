<?php
/**
 * @brief		nbRecentTopicsPosts Widget
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Social Suite
 * @subpackage	nbRecentTopicsPosts
 * @since		05 Feb 2015
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\plugins\nb40recenttopicsposts\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * nbRecentTopicsPosts Widget
 */
// class _nbRecentTopicsPosts extends \IPS\Widget
class _nbRecentTopicsPosts extends \IPS\Widget\PermissionCache
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'nbRecentTopicsPosts';

	/**
	 * @brief	App
	 */


	/**
	 * @brief	Plugin
	 */
	public $plugin = '2';

	public function __construct( $uniqueKey, array $configuration, $access=null, $orientation=null )
	{
		if ((isset($configuration['nb_tab_top_pos_forum_view']) and $configuration['nb_tab_top_pos_forum_view'] > 0) or (isset($configuration['nb_tab_top_pos_topic_view']) and $configuration['nb_tab_top_pos_topic_view'] > 0))
		{
			if (defined('NB_RECENT_TOPICS_POSTS_NEVER_CACHE') and (int) NB_RECENT_TOPICS_POSTS_NEVER_CACHE > 0)
			{
				$this->neverCache = true;
			}
			else
			{
				$forumId = 0;

				if ($configuration['nb_tab_top_pos_forum_view'] > 0 and \IPS\Request::i()->app == 'forums' and \IPS\Request::i()->module == 'forums' and \IPS\Request::i()->controller == 'forums' and intval(\IPS\Request::i()->id) > 0)
				{
					try
					{
						$forumId = \IPS\Request::i()->id;
					}
					catch( \Exception $e )
					{
					}
				}
				elseif ($configuration['nb_tab_top_pos_topic_view'] > 0 and \IPS\Request::i()->app == 'forums' and \IPS\Request::i()->module == 'forums' and \IPS\Request::i()->controller == 'topic' and intval(\IPS\Request::i()->id) > 0)
				{
					try
					{
						$topic = \IPS\forums\Topic::loadAndCheckPerms(\IPS\Request::i()->id);

						$forumId = $topic->container()->_id;
					}
					catch( \Exception $e )
					{
					}
				}

				if ($forumId > 0)
				{
					$configuration['nb_tab_top_pos_forum_view_id'] = $forumId;
				}
			}
		}

		parent::__construct( $uniqueKey, $configuration, $access, $orientation );
	}

	/**
	 * Initialise this widget
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		$this->template(array(\IPS\Theme::i()->getTemplate('plugins', 'core', 'global'), $this->key));
	}

	/**
	 * Specify widget configuration
	 *
	 * @param	null|\IPS\Helpers\Form	$form	Form object
	 * @return	null|\IPS\Helpers\Form
	 */
	public function configuration( &$form=null )
	{
		if ($form === null)
		{
			$form = new \IPS\Helpers\Form;
		}

 		$form->addHeader('nb_tab_top_pos_tab_gl');

		/* Enable hook? */
		$form->add( new \IPS\Helpers\Form\YesNo( 'nb_tab_top_pos_on', isset($this->configuration['nb_tab_top_pos_on']) ? $this->configuration['nb_tab_top_pos_on'] : 1 ) );

		$selectors = array(
			'global' => array(
				'form_header_nb_tab_top_pos_tab_gl',
				'form_nb_tab_top_pos_on',
				'form_nb_tab_top_pos_tabs_style',
				'form_nb_tab_top_pos_title_recent',
				'form_nb_tab_top_pos_title_posts',
				'form_nb_tab_top_pos_title_topics',
				'form_nb_tab_top_pos_grs',
				'form_nb_tab_top_pos_grs_s_hide',
				'form_nb_tab_top_pos_show_tabs',
				'form_nb_tab_top_pos_first_tab',
				'form_nb_tab_top_pos_forum_view',
				'form_nb_tab_top_pos_topic_view',
				'form_nb_tab_top_pos_forum_topic_inc_sub',
			),
			'topics' => array(
				'form_header_nb_tab_top_pos_tab_t',
				'nb_tab_top_pos_ct',
				'form_nb_tab_top_pos_ft',
				'form_nb_tab_top_pos_ft_ex',
				'form_nb_tab_top_pos_sft',
				'form_nb_tab_top_pos_snat',
				'form_nb_tab_top_pos_sdatt',
				'form_nb_tab_top_pos_savat',
				'form_nb_tab_top_pos_spcountert',
				'form_nb_tab_top_pos_statet',
				'form_nb_tab_top_pos_goto_usert',
				'form_nb_tab_top_pos_goto_guestt',
			),
			'posts' => array(
				'form_header_nb_tab_top_pos_tab_p',
				'nb_tab_top_pos_cp',
				'form_nb_tab_top_pos_fp',
				'form_nb_tab_top_pos_fp_ex',
				'form_nb_tab_top_pos_sfp',
				'form_nb_tab_top_pos_snap',
				'form_nb_tab_top_pos_sdatp',
				'form_nb_tab_top_pos_savap',
				'form_nb_tab_top_pos_spcounterp',
				'form_nb_tab_top_pos_rowpt',
				'form_nb_tab_top_pos_show_text',
				'nb_tab_top_pos_show_text_trunc',
				'form_nb_tab_top_pos_statep',
				'form_nb_tab_top_pos_goto_userp',
				'form_nb_tab_top_pos_goto_guestp',
			),
		);

		$form->add( new \IPS\Helpers\Form\Select(
			'nb_tab_top_pos_show_tabs',
			isset($this->configuration['nb_tab_top_pos_show_tabs']) ? $this->configuration['nb_tab_top_pos_show_tabs'] : 'all',
			true,
			array(
				'options' 		=> array(
					'topics' => 'nb_tab_top_pos_show_tabs_topics',
					'posts'  => 'nb_tab_top_pos_show_tabs_posts',
					'all'    => 'nb_tab_top_pos_show_tabs_all',
				),
				'toggles'		=> array(
					'topics' => array_merge($selectors['topics'], array('form_nb_tab_top_pos_title_topics')),
					'posts'  => array_merge($selectors['posts'], array('form_nb_tab_top_pos_title_posts')),
					'all'    => array_merge($selectors['topics'], $selectors['posts'], array('form_nb_tab_top_pos_first_tab', 'form_nb_tab_top_pos_title_topics', 'form_nb_tab_top_pos_title_posts')),
				),
				'multiple' 		=> false
			)
		) );

		/* Tabs style */
		$form->add( new \IPS\Helpers\Form\Select(
			'nb_tab_top_pos_tabs_style',
			$this->configuration['nb_tab_top_pos_tabs_style'],
			false,
			array( 'options' => array('style1' => 'nb_tab_top_pos_tabs_style1', 'style2' => 'nb_tab_top_pos_tabs_style2') )
		) );

		/* Title - Recent */
		$nb_tab_top_pos_title_recent_val = new \IPS\Helpers\Form\Translatable( 'nb_tab_top_pos_title_recent', NULL, false, array( 'app' => 'core', 'key' => 'nb_tab_top_pos_title_recent_val' ) );

		/* Title - Posts */
		$nb_tab_top_pos_title_posts_val = new \IPS\Helpers\Form\Translatable( 'nb_tab_top_pos_title_posts', NULL, false, array( 'app' => 'core', 'key' => 'nb_tab_top_pos_title_posts_val' ) );

		/* Title - Topics */
		$nb_tab_top_pos_title_topics_val = new \IPS\Helpers\Form\Translatable( 'nb_tab_top_pos_title_topics', NULL, false, array( 'app' => 'core', 'key' => 'nb_tab_top_pos_title_topics_val' ) );

		$titleConfig = $this->configuration['nb_tab_top_pos_title'] ? json_decode($this->configuration['nb_tab_top_pos_title'], true) : array();

		if (!isset(\IPS\Request::i()->nb_tab_top_pos_title_recent))
		{
			$nb_tab_top_pos_title_recent_val->value = $titleConfig['nb_tab_top_pos_title_recent'] ?: array();
		}
		if (!isset(\IPS\Request::i()->nb_tab_top_pos_title_posts))
		{
			$nb_tab_top_pos_title_posts_val->value = $titleConfig['nb_tab_top_pos_title_posts'] ?: array();
		}
		if (!isset(\IPS\Request::i()->nb_tab_top_pos_title_topics))
		{
			$nb_tab_top_pos_title_topics_val->value = $titleConfig['nb_tab_top_pos_title_topics'] ?: array();
		}

		$form->add($nb_tab_top_pos_title_recent_val);
		$form->add($nb_tab_top_pos_title_posts_val);
		$form->add($nb_tab_top_pos_title_topics_val);

		/** Groups
		 * Select groups that can view block
		 */
		$form->add( new \IPS\Helpers\Form\Select(
			'nb_tab_top_pos_grs',
			$this->configuration['nb_tab_top_pos_grs'] ?: array(),
			false,
			array( 	'options' => array_combine( array_keys( \IPS\Member\Group::groups() ), array_map( function( $_group ) { return (string) $_group; }, \IPS\Member\Group::groups() ) ),
					'multiple' => true,
					'unlimited' => 'all',
					'unlimitedLang' => 'all_groups'
			)
		) );

		/* Hide from secondary */
		$form->add( new \IPS\Helpers\Form\Select(
			'nb_tab_top_pos_grs_s_hide',
			$this->configuration['nb_tab_top_pos_grs_s_hide'] ?: array(),
			false,
			array(
				'options' => array_combine( array_keys( \IPS\Member\Group::groups() ), array_map( function( $_group ) { return (string) $_group; }, \IPS\Member\Group::groups() ) ),
				'multiple' => true,
			)
		) );

		/* First tab */
		$form->add( new \IPS\Helpers\Form\Select(
			'nb_tab_top_pos_first_tab',
			isset($this->configuration['nb_tab_top_pos_first_tab']) ? $this->configuration['nb_tab_top_pos_first_tab'] : 'posts',
			false,
			array(  'options' => array('posts' => 'nb_tab_top_pos_first_tab_posts', 'topics' => 'nb_tab_top_pos_first_tab_topics'),
			)
		) );

		$form->add( new \IPS\Helpers\Form\YesNo( 'nb_tab_top_pos_forum_view', isset($this->configuration['nb_tab_top_pos_forum_view']) ? $this->configuration['nb_tab_top_pos_forum_view'] : 0 ) );

		$form->add( new \IPS\Helpers\Form\YesNo( 'nb_tab_top_pos_topic_view', isset($this->configuration['nb_tab_top_pos_topic_view']) ? $this->configuration['nb_tab_top_pos_topic_view'] : 0 ) );

		$form->add( new \IPS\Helpers\Form\YesNo( 'nb_tab_top_pos_forum_topic_inc_sub', isset($this->configuration['nb_tab_top_pos_forum_topic_inc_sub']) ? $this->configuration['nb_tab_top_pos_forum_topic_inc_sub'] : 0 ) );

		// Topics tab
		$form->addHeader('nb_tab_top_pos_tab_t');

		if ($topicsFields = $this->postsTopicsFields('topics'))
		{
			foreach ($topicsFields as $tfield)
			{
				$form->add($tfield);
			}
		}

		// Posts tab
		$form->addHeader('nb_tab_top_pos_tab_p');
		if ($postsFields = $this->postsTopicsFields('posts'))
		{
			foreach ($postsFields as $pfield)
			{
				$form->add($pfield);
			}
		}

		return $form;
 	}

	protected function postsTopicsFields($tab)
	{
		$fields = array();
		$tabs = array('topics' => 't', 'posts' => 'p');

		if (!array_key_exists($tab, $tabs))
		{
			return $fields;
		}

		$suffix = $tabs[$tab];

		/* Number of items to show */
		$fields[] = new \IPS\Helpers\Form\Number(
			"nb_tab_top_pos_c{$suffix}",
			isset($this->configuration["nb_tab_top_pos_c{$suffix}"]) ? $this->configuration["nb_tab_top_pos_c{$suffix}"] : 10,
			false,
			array(),
			null,
			null,
			null,
			"nb_tab_top_pos_c{$suffix}"
		);

		/* Include forums */
		$fields[] = new \IPS\Helpers\Form\Node(
			"nb_tab_top_pos_f{$suffix}",
			$this->configuration["nb_tab_top_pos_f{$suffix}"] != 0 ? $this->configuration["nb_tab_top_pos_f{$suffix}"] : 0,
			false,
			array(
				'class'		=> 'IPS\forums\Forum',
				'zeroVal'	=> 'nb_tab_top_pos_all_forums',
				'multiple'	=> true
			)
		);

		/** Exclude forums
		 *  https://community.invisionpower.com/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2613666
		 */
		$fields[] = new \IPS\Helpers\Form\Node(
			"nb_tab_top_pos_f{$suffix}_ex",
			$this->configuration["nb_tab_top_pos_f{$suffix}_ex"],
			false,
			array(
				'class'		=> 'IPS\forums\Forum',
				'multiple'	=> true
			)
		);

		/* Show prefixes? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_sprefix{$suffix}", isset($this->configuration["nb_tab_top_pos_sprefix{$suffix}"]) ? $this->configuration["nb_tab_top_pos_sprefix{$suffix}"] : 0 );

		/* Show tags? */
		$fields[] = new \IPS\Helpers\Form\YesNo(
			"nb_tab_top_pos_stags{$suffix}",
			isset($this->configuration["nb_tab_top_pos_stags{$suffix}"]) ? $this->configuration["nb_tab_top_pos_stags{$suffix}"] : 0,
			false,
			array(
				'togglesOn' => array(
					"form_nb_tab_top_pos_stags_condensed{$suffix}",
				)
			)
		);

		/* Condensed mode? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_stags_condensed{$suffix}", isset($this->configuration["nb_tab_top_pos_stags_condensed{$suffix}"]) ? $this->configuration["nb_tab_top_pos_stags_condensed{$suffix}"] : 0 );

		/* Show forum name? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_sf{$suffix}", isset($this->configuration["nb_tab_top_pos_sf{$suffix}"]) ? $this->configuration["nb_tab_top_pos_sf{$suffix}"] : 1 );

		/* Show member name? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_sna{$suffix}", isset($this->configuration["nb_tab_top_pos_sna{$suffix}"]) ? $this->configuration["nb_tab_top_pos_sna{$suffix}"] : 1 );

		/* Show date? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_sdat{$suffix}", isset($this->configuration["nb_tab_top_pos_sdat{$suffix}"]) ? $this->configuration["nb_tab_top_pos_sdat{$suffix}"] : 1 );

		/* Show avatars? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_sava{$suffix}", isset($this->configuration["nb_tab_top_pos_sava{$suffix}"]) ? $this->configuration["nb_tab_top_pos_sava{$suffix}"] : 1 );

		/* Show post counter? */
		$fields[] = new \IPS\Helpers\Form\YesNo( "nb_tab_top_pos_spcounter{$suffix}", isset($this->configuration["nb_tab_top_pos_spcounter{$suffix}"]) ? $this->configuration["nb_tab_top_pos_spcounter{$suffix}"] : 1 );

		// https://invisionpower.com/forums/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2684122
		// 1.0.7
		$states = array(
			'any'    => 'mod_confirm_either',
			'open'   => 'mod_confirm_unlock',
			'closed' => 'mod_confirm_lock'
		);

		$fields[] = new \IPS\Helpers\Form\Radio( "nb_tab_top_pos_state{$suffix}", isset($this->configuration["nb_tab_top_pos_state{$suffix}"]) ? $this->configuration["nb_tab_top_pos_state{$suffix}"] : 'any', false, array( 'options' => $states ) );

		$goToOptions = array(
			'first_post' 		 => 'nb_tab_top_pos_goto_first_post',
			'first_unread_post'  => 'nb_tab_top_pos_goto_first_unread_post',
			'last_post'  		 => 'nb_tab_top_pos_goto_last_post',
		);

		if ($tab == 'posts')
		{
			$goToOptions['current_post'] = 'nb_tab_top_pos_goto_current_post';
		}

		$fields[] = new \IPS\Helpers\Form\Select(
			"nb_tab_top_pos_goto_user{$suffix}",
			isset($this->configuration["nb_tab_top_pos_goto_user{$suffix}"]) ? $this->configuration["nb_tab_top_pos_goto_user{$suffix}"] : ($tab == 'posts' ? 'current_post' : 'first_post'),
			false,
			array( 'options' => $goToOptions )
		);

		$fields[] = new \IPS\Helpers\Form\Select(
			"nb_tab_top_pos_goto_guest{$suffix}",
			isset($this->configuration["nb_tab_top_pos_goto_guest{$suffix}"]) ? $this->configuration["nb_tab_top_pos_goto_guest{$suffix}"] : ($tab == 'posts' ? 'current_post' : 'first_post'),
			false,
			array( 'options' => array_diff($goToOptions, array('nb_tab_top_pos_goto_first_unread_post')) )
		);

		if ($tab == 'posts')
		{
			/** 1 row per topic
			 *  https://community.invisionpower.com/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2599199
			 */
			$fields[] = new \IPS\Helpers\Form\YesNo(
				'nb_tab_top_pos_rowpt',
				isset($this->configuration['nb_tab_top_pos_rowpt']) ? $this->configuration['nb_tab_top_pos_rowpt'] : 0,
				false,
				array('togglesOn' => array( 'nb_tab_top_pos_gotop' ))
			);

			// https://invisionpower.com/forums/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2654694
			$fields[] = new \IPS\Helpers\Form\YesNo(
				'nb_tab_top_pos_show_text',
				isset($this->configuration['nb_tab_top_pos_show_text']) ? $this->configuration['nb_tab_top_pos_show_text'] : 0,
				false,
				array('togglesOn' => array( 'nb_tab_top_pos_show_text_trunc' ))
			);

			// https://invisionpower.com/forums/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2654694
			$fields[] = new \IPS\Helpers\Form\Number(
				'nb_tab_top_pos_show_text_trunc',
				isset($this->configuration['nb_tab_top_pos_show_text_trunc']) ? $this->configuration['nb_tab_top_pos_show_text_trunc'] : 0,
				false,
				array(),
				null,
				null,
				null,
				'nb_tab_top_pos_show_text_trunc'
			);
		}

		return $fields;
	}

	/**
	 * Ran before saving widget configuration
	 *
	 * @param	array	$values	Values from form
	 * @return	array
	 */
 	public function preConfig( $values )
 	{
		$widgetTitle = array(
			'nb_tab_top_pos_title_recent',
			'nb_tab_top_pos_title_posts',
			'nb_tab_top_pos_title_topics',
		);

		$temp = array();

		foreach ($widgetTitle as $l)
		{
			$temp[$l] = $values[$l];

			unset($values[$l]);
		}

		$values['nb_tab_top_pos_title'] = json_encode($temp);

		foreach (array('nb_tab_top_pos_ft', 'nb_tab_top_pos_ft_ex', 'nb_tab_top_pos_fp', 'nb_tab_top_pos_fp_ex') as $setting)
		{
			if (is_array($values[$setting]) and count($values[$setting]))
			{
				$values[$setting] = array_keys($values[$setting]);
			}
		}

		return $values;
 	}

	/**
	 * Render a widget
	 *
	 * @return	string
	 */
	public function render()
	{
		$this->configuration['nb_tab_top_pos_goto_usert']  = isset($this->configuration['nb_tab_top_pos_goto_usert']) ? $this->configuration['nb_tab_top_pos_goto_usert'] : 'first_post';
		$this->configuration['nb_tab_top_pos_goto_guestt'] = isset($this->configuration['nb_tab_top_pos_goto_guestt']) ? $this->configuration['nb_tab_top_pos_goto_guestt'] : 'first_post';

		$this->configuration['nb_tab_top_pos_goto_userp']  = isset($this->configuration['nb_tab_top_pos_goto_userp']) ? $this->configuration['nb_tab_top_pos_goto_userp'] : 'current_post';
		$this->configuration['nb_tab_top_pos_goto_guestp'] = isset($this->configuration['nb_tab_top_pos_goto_guestp']) ? $this->configuration['nb_tab_top_pos_goto_guestp'] : 'current_post';

		/* Only for sidebar */
		if ($this->orientation != 'vertical')
		{
			return '';
		}

		/* On-Off */
		if (!$this->configuration['nb_tab_top_pos_on'])
		{
			return '';
		}

		/* Groups that can view block */
		if (!($this->configuration['nb_tab_top_pos_grs'] == 'all' or \IPS\Member::loggedIn()->inGroup($this->configuration['nb_tab_top_pos_grs'])))
		{
			return '';
		}

		/** Hide block from users if they have selected groups as secondary
		 *  https://community.invisionpower.com/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2619880
		 */
		if (is_array($this->configuration['nb_tab_top_pos_grs_s_hide']) and count($this->configuration['nb_tab_top_pos_grs_s_hide']) and \IPS\Member::loggedIn()->mgroup_others)
		{
			foreach ($this->configuration['nb_tab_top_pos_grs_s_hide'] as $gr)
			{
				if (in_array($gr, explode(',', \IPS\Member::loggedIn()->mgroup_others)))
				{
					return '';
				}
			}
		}

		$showFromSubforums = isset($this->configuration['nb_tab_top_pos_forum_topic_inc_sub']) ? $this->configuration['nb_tab_top_pos_forum_topic_inc_sub'] : 0;

		/* Topics settings */
		$limitTopics	= $this->configuration['nb_tab_top_pos_ct'];
		$limitTopics	= $limitTopics > 0 ? $limitTopics : 10;
		$fidsTopics		= $this->configuration['nb_tab_top_pos_ft'] != 0 ? $this->configuration['nb_tab_top_pos_ft'] : 0;

		/* Posts settings */
		$limitPosts		= $this->configuration['nb_tab_top_pos_cp'];
		$limitPosts		= $limitPosts > 0 ? $limitPosts : 10;
		$fidsPosts		= $this->configuration['nb_tab_top_pos_fp'] != 0 ? $this->configuration['nb_tab_top_pos_fp'] : 0;

		$whereTopics = array();
		$wherePosts = array();

		/* Get topics */
		$fromCurrentForum = false;

		if(isset($this->configuration['nb_tab_top_pos_forum_view_id']) and $this->configuration['nb_tab_top_pos_forum_view_id'])
		{
			$fromCurrentForum = true;

			if ($showFromSubforums)
			{
				$fids = array();

				try
				{
					$forum = \IPS\forums\Forum::loadAndCheckPerms((int) $this->configuration['nb_tab_top_pos_forum_view_id']);

					$fids[$forum->_id] = $forum->_id;

					if ($forum->hasChildren())
					{
						foreach ($forum->children() as $child)
						{
							$fids[$child->_id] = $child->_id;

							while ($child = $child->children())
							{
								foreach ($child as $child)
								{
									$fids[$child->_id] = $child->_id;
								}
							}
						}
					}
				}
				catch( \Exception $e )
				{
				}

				if ($fids)
				{
					$whereTopics[] = array(\IPS\Db::i()->in( 'forum_id', $fids ));
					$wherePosts[] = array(\IPS\Db::i()->in( 'forum_id', $fids ));
				}
			}
			else
			{
				$whereTopics[] = array('forum_id=?', (int) $this->configuration['nb_tab_top_pos_forum_view_id']);
				$wherePosts[] = array('forum_id=?', (int) $this->configuration['nb_tab_top_pos_forum_view_id']);
			}
		}


		$this->configuration['nb_tab_top_pos_show_tabs'] = isset($this->configuration['nb_tab_top_pos_show_tabs']) ? $this->configuration['nb_tab_top_pos_show_tabs'] : 'all';

		$topics = array();

		if ($this->configuration['nb_tab_top_pos_show_tabs'] == 'all' or $this->configuration['nb_tab_top_pos_show_tabs'] == 'topics')
		{
			if (!$fromCurrentForum)
			{
				/* Include forums (topics) */
				if (isset($fidsTopics) and is_array($fidsTopics) and count($fidsTopics))
				{
					$whereTopics[] = array(\IPS\Db::i()->in( 'forum_id', $fidsTopics ));
				}

				/* Exclude forums (topics) */
				if (isset($this->configuration['nb_tab_top_pos_ft_ex']) and is_array($this->configuration['nb_tab_top_pos_ft_ex']) and count($this->configuration['nb_tab_top_pos_ft_ex']))
				{
					$whereTopics[] = array(\IPS\Db::i()->in( 'forum_id', $this->configuration['nb_tab_top_pos_ft_ex'], true ));
				}
			}

			/* Topics state */
			if (isset($this->configuration['nb_tab_top_pos_statet']) and in_array($this->configuration['nb_tab_top_pos_statet'], array('open', 'closed')))
			{
				$whereTopics[] = array("state = ?", $this->configuration['nb_tab_top_pos_statet']);
			}

			$topics = \IPS\forums\Topic::getItemsWithPermission($whereTopics, null, $limitTopics);
		}

		/* Get posts */
		$posts = array();

		if ($this->configuration['nb_tab_top_pos_show_tabs'] == 'all' or $this->configuration['nb_tab_top_pos_show_tabs'] == 'posts')
		{
			if (!$fromCurrentForum)
			{
				/* Include forums (posts) */
				if (isset($fidsPosts) and is_array($fidsPosts) and count($fidsPosts))
				{
					$wherePosts[] = array(\IPS\Db::i()->in( 'forum_id', $fidsPosts ));
				}

				/* Exclude forums (posts) */
				if (isset($this->configuration['nb_tab_top_pos_fp_ex']) and is_array($this->configuration['nb_tab_top_pos_fp_ex']) and count($this->configuration['nb_tab_top_pos_fp_ex']))
				{
					$wherePosts[] = array(\IPS\Db::i()->in( 'forum_id', $this->configuration['nb_tab_top_pos_fp_ex'], true ));
				}
			}

			if ($this->configuration['nb_tab_top_pos_rowpt'])
			{
				$wherePosts[] = array('forums_topics.last_post=forums_posts.post_date'); // https://community.invisionpower.com/topic/408449-nb40-recent-topicsposts/?do=findComment&comment=2599199
			}

			/* Topics state */
			if (isset($this->configuration['nb_tab_top_pos_statep']) and in_array($this->configuration['nb_tab_top_pos_statep'], array('open', 'closed')))
			{
				$wherePosts[] = array("forums_topics.state = ?", $this->configuration['nb_tab_top_pos_statep']);
			}

			$posts = \IPS\forums\Topic\Post::getItemsWithPermission($wherePosts, null, $limitPosts);
		}

		/* First and selected tabs */
		$firstTab = $this->configuration['nb_tab_top_pos_first_tab'] == 'topics' ? 'topics' : 'posts';

		$tabs = array(
			'posts' => 'Posts',
			'topics' => 'Topics',
		);

		if ($firstTab == 'topics')
		{
			$tabs = array_reverse($tabs);
		}

		$selectedTab = $firstTab;

		$cookie = 'nbRecTPTabs_' . $this->uniqueKey;

		if (isset(\IPS\Request::i()->cookie[$cookie]) and array_key_exists(\IPS\Request::i()->cookie[$cookie], $tabs))
		{
			$selectedTab = \IPS\Request::i()->cookie[$cookie];
		}

		$titleConfig = json_decode($this->configuration['nb_tab_top_pos_title'], true);

		$widgetTitle = array();

		foreach($titleConfig as $k => $conf)
		{
			$defKey = str_replace('nb_tab_top_pos_title_', 'nb_tab_rtp_', $k);

			$widgetTitle[$k] = (isset($titleConfig[$k][\IPS\Member::loggedIn()->language()->id]) and $titleConfig[$k][\IPS\Member::loggedIn()->language()->id]) ? $titleConfig[$k][\IPS\Member::loggedIn()->language()->id] : \IPS\Member::loggedIn()->language()->addToStack( $defKey );
		}

		if ($this->configuration['nb_tab_top_pos_show_tabs'] == 'topics')
		{
			$firstTab = 'topics';
			$selectedTab = 'topics';
			unset($tabs['posts']);
			$this->configuration['nb_tab_top_pos_tabs_style'] = 'style1';
		}
		elseif ($this->configuration['nb_tab_top_pos_show_tabs'] == 'posts')
		{
			$firstTab = 'posts';
			$selectedTab = 'posts';
			unset($tabs['topics']);
			$this->configuration['nb_tab_top_pos_tabs_style'] = 'style1';
		}

		$config = $this->configuration;

		$goToUrl = function($content) use ($config)
		{
			$url = \IPS\Http\Url::internal('');

			if ($content instanceof \IPS\forums\Topic)
			{
				$url = $content->url();

				if (\IPS\Member::loggedIn()->member_id)
				{
					if ($config['nb_tab_top_pos_goto_usert'] == 'first_unread_post')
					{
						$url = $content->url('getNewComment');
					}
					elseif ($config['nb_tab_top_pos_goto_usert'] == 'last_post')
					{
						$url = $content->url('getLastComment');
					}
				}
				else
				{
					if ($config['nb_tab_top_pos_goto_guestt'] == 'last_post')
					{
						$url = $content->url('getLastComment');
					}
				}
			}
			elseif ($content instanceof \IPS\forums\Topic\Post)
			{
				$url = $content->item()->url()->setQueryString(array('do' => 'findComment', 'comment' => $content->pid));

				if (\IPS\Member::loggedIn()->member_id)
				{
					if ($config['nb_tab_top_pos_goto_userp'] == 'first_post')
					{
						$url = $content->item()->url();
					}
					elseif ($config['nb_tab_top_pos_goto_userp'] == 'last_post')
					{
						$url = $content->item()->url('getLastComment');
					}
					elseif ($config['nb_tab_top_pos_goto_userp'] == 'first_unread_post')
					{
						$url = $content->item()->url('getNewComment');
					}
				}
				else
				{
					if ($config['nb_tab_top_pos_goto_guestp'] == 'first_post')
					{
						$url = $content->item()->url();
					}
					elseif ($config['nb_tab_top_pos_goto_guestp'] == 'last_post')
					{
						$url = $content->item()->url('getLastComment');
					}
				}
			}

			return $url;
		};

		/* Return */
		return $this->output($topics, $posts, $selectedTab, $tabs, $firstTab, $this->configuration, $this->uniqueKey, $widgetTitle, $goToUrl);
	}
}
