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
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.funtoo.js' );
	}
 
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
 * BaseTemplate class for Foo Bar skin
 *
 * @ingroup Skins
 */
class funtooTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' ); ?>
<!--your fun stuff-->

<!--page title-->
<?php if ( !empty( $this->data['title'] ) ) { ?>
<h1 id="firstHeading" class="firstHeading"><?php $this->html( 'title' ) ?></h1>
<?php } ?>
<!--end of page title-->

<!--body text-->
<?php $this->html( 'bodytext' ) ?>
<!--end of body text-->

<!--categories-->
<?php $this->html( 'catlinks' ); ?>
<!--end of categories-->

<!--data after content-->
<?php $this->html( 'dataAfterContent' ); ?>
<!--end of data after content-->

<!--language links-->
<?php
	// Language links are often not present, so this if-statement allows you to add a conditional <ul> around the language list
	if ( $this->data['language_urls'] ) {
		echo "<ul>";
		foreach ( $this->data['language_urls'] as $key => $langLink ) {
			echo $this->makeListItem( $key, $langLink );
		}
		echo "</ul>";
	} 
?>
<!--end of language links-->

<!--user message new talk-->
<?php $this->html( 'newtalk' ); ?>

<?php if ( $this->data['newtalk'] ) { ?>
<div class="usermessage"> <!-- The CSS class used in Monobook and Vector, if you want to follow a similar design -->
<?php $this->html( 'newtalk' );?>
</div>
<?php } ?>
<!--end of user message new talk-->

<!--subtitles-->
<?php $this->html( 'subtitle' ); ?>
<?php $this->html( 'undelete' ); ?>
<?php if ( $this->data['subtitle'] ) { ?>
<div id="contentSub"> <!-- The CSS class used in Monobook and Vector, if you want to follow a similar design -->
<?php $this->html( 'subtitle' ); ?>
</div>
<?php } ?>
<?php if ( $this->data['undelete'] ) { ?>
<div id="contentSub2"> <!-- The CSS class used in Monobook and Vector, if you want to follow a similar design -->
<?php $this->html( 'undelete' ); ?>
</div>
<?php } ?>
<!--end of subtitles-->

<!--personal tools-->

<nav class="nav">
<nav class="navbar navbar-default">
<ul class="nav nav-pills">
<a class="navbar-brand"	href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] );	?>"
	<?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>
>
<img src="<?php echo $this->getSkin()->getSkinStylePath( 'resources/images/funtoo.png'); 
?>" alt="logo" class="logo"></img>
</a>
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      user <span class="caret"></span>
    </a>
<ul class="dropdown-menu" role="menu">
<?php
	foreach ( $this->getPersonalTools() as $key => $item ) {
		echo $this->makeListItem( $key, $item );
	}
?>
</ul>
</li>
<!--content actions-->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
      page <span class="caret"></span>
    </a>
<ul class="dropdown-menu" role="menu">
<?php
	foreach ( $this->data['content_actions'] as $key => $tab ) {
		echo $this->makeListItem( $key, $tab );
	}
?>
</ul>
</li>
</ul>
</nav>
</nav>
<!--search-->

<form action="<?php $this->text( 'wgScript' ); ?>">
	<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
<?php echo $this->makeSearchInput( array( 'id' => 'searchInput' ) ); ?>
<?php echo $this->makeSearchButton( 'go' ); ?>
</form>

<!--sidebar-->
<?php
foreach ( $this->getSidebar() as $boxName => $box ) { ?>
<div id="<?php echo Sanitizer::escapeId( $box['id'] ) ?>"<?php echo Linker::tooltip( $box['id'] ) ?>>
<?php
	if ( is_array( $box['content'] ) ) { ?>
	<ul>
<?php
		foreach ( $box['content'] as $key => $item ) {
			echo $this->makeListItem( $key, $item );
		}
?>
	</ul>
<?php
	} else {
		echo $box['content'];
	}
} ?>

<!--footer icons-->
<?php
	foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
	<div class="center">
<?php
		foreach ( $footerIcons as $icon ) {
			echo $this->getSkin()->makeFooterIcon( $icon );
		}
?>
	</div>
<?php
	} ?>

<!--footer links flat array-->

<div class="center">
<?php foreach ( $this->getFooterLinks( 'flat' ) as $key ) { ?>
	<div class="btn button"><?php $this->html( $key ) ?></div><br />
 
<?php } ?>
</div>

<!--end of your fun stuff-->

<?php $this->printTrail(); ?>
</body>
</html><?php
	}
}