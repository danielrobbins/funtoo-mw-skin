<?php
/**
 * Skin file for skin funtoo.
 *
 * @file
 * @ingroup Skins
 */
/**
 * SkinTemplate class for funtoo skin
 * @ingroup Skins
 */
class Skinfuntoo extends SkinTemplate {
	var $skinname = 'funtoo', $stylename = 'funtoo',
		$template = 'funtooTemplate', $useHeadElement = true;
 
	/**
	 * Add JavaScript via ResourceLoader
	 *
	 * Uncomment this function if your skin has a JS file or files.
	 * Otherwise you won't need this function and you can safely delete it.
	 *
	 * @param OutputPage $out
	 */
	/*
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.foobar.js' );
	}
	*/
 
	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( array(
			'mediawiki.skinning.interface', 'skins.funtoo'
		) );
	}
}
/**
 * BaseTemplate class for funtoo skin
 *
 * @ingroup Skins
 */
class funtooTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ); ?>
 
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$this->html( 'headelement' );
		?>

		<!-- heading -->
		<div id="mw_header"><h1 id="firstHeading" lang="<?php
			$this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
			$this->text( 'pageLanguage' );
			?>"><span dir="auto"><?php $this->html( 'title' ) ?></span></h1></div>

		<div id="mw_main">
			<div id="mw_contentwrapper">
				<!-- navigation portlet -->
				<?php $this->cactions(); ?>

				<!-- content -->
				<div id="mw_content" role="main">
					<!-- contentholder does nothing by default, but it allows users to style the text inside
						 the content area without affecting the meaning of 'em' in #mw_content, which is used
						 for the margins -->
					<div id="mw_contentholder" class="mw-body">
						<div class='mw-topboxes'>
							<div id="mw-js-message"
								style="display:none;"<?php $this->html( 'userlangattributes' ) ?>></div>
							<div class="mw-topbox" id="siteSub"><?php $this->msg( 'tagline' ) ?></div>
							<?php
							if ( $this->data['newtalk'] ) {
								?>
								<div class="usermessage mw-topbox"><?php $this->html( 'newtalk' ) ?></div>
							<?php
							}
							?>
							<?php
							if ( $this->data['sitenotice'] ) {
								?>
								<div class="mw-topbox" id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
							<?php
							}
							?>
						</div>

						<div id="contentSub"<?php
						$this->html( 'userlangattributes' )
						?>><?php
							$this->html( 'subtitle' )
							?></div>

						<?php
						if ( $this->data['undelete'] ) {
							?>
							<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div><?php
						}
						?>
						<div id="jump-to-nav"><?php $this->msg( 'jumpto' ) ?>
							<a href="#mw_portlets"><?php
								$this->msg( 'jumptonavigation' ) ?></a><?php $this->msg( 'comma-separator' )
							?>
							<a href="#searchInput"><?php $this->msg( 'jumptosearch' ) ?></a>
						</div>

						<?php $this->html( 'bodytext' ) ?>
						<div class='mw_clear'></div>
						<?php
						if ( $this->data['catlinks'] ) {
							$this->html( 'catlinks' );
						}
						?>
						<?php $this->html( 'dataAfterContent' ) ?>
					</div><!-- mw_contentholder -->
				</div><!-- mw_content -->
			</div><!-- mw_contentwrapper -->

			<div id="mw_portlets"<?php $this->html( "userlangattributes" ) ?>>
				<h2><?php $this->msg( 'navigation-heading' ) ?></h2>

				<!-- portlets -->
				<?php $this->renderPortals( $this->data['sidebar'] ); ?>

			</div><!-- mw_portlets -->


		</div><!-- main -->

		<div class="mw_clear"></div>

		<!-- personal portlet -->
		<div class="portlet" id="p-personal" role="navigation">
			<h3><?php $this->msg( 'personaltools' ) ?></h3>

			<div class="pBody">
				<ul>
					<?php
					foreach ( $this->getPersonalTools() as $key => $item ) {
						?>
						<?php echo $this->makeListItem( $key, $item ); ?>

					<?php
					}
					?>
				</ul>
			</div>
		</div>


		<!-- footer -->
		<div id="footer" role="contentinfo"<?php $this->html( 'userlangattributes' ) ?>>
			<ul id="f-list">
				<?php
				foreach ( $this->getFooterLinks( "flat" ) as $aLink ) {
					if ( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
						?>
						<li id="<?php echo $aLink ?>"><?php $this->html( $aLink ) ?></li>
					<?php
					}
				}
				?>
			</ul>
			<?php
			foreach ( $this->getFooterIcons( "nocopyright" ) as $blockName => $footerIcons ) {
				?>
				<div id="mw_<?php echo htmlspecialchars( $blockName ); ?>">
					<?php
					foreach ( $footerIcons as $icon ) {
						?>
						<?php echo $this->getSkin()->makeFooterIcon( $icon, 'withoutImage' ); ?>

					<?php
					} ?>
				</div>
			<?php
			}
			?>
		</div>
 
<?php $this->printTrail(); ?>
</body>
</html><?php
		wfRestoreWarnings();
	}
}