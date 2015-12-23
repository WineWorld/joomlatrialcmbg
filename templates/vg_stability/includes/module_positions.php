<?php
/****************************** bodysidebar ******************************/

// bodysidebar - 2 positions
if(  $this->countModules('bodyleft') and $this->countModules('bodyright') ){
	$bodysidebar = array(
		'col-md-3',
		'col-md-5',
		'col-md-3'
	);
}

// bodysidebar - 1 position
if(  $this->countModules('bodyleft') and !$this->countModules('bodyright') ){
	$bodysidebar = array(
		'col-md-3',
		'col-md-9',
		''
	);
}
if(  !$this->countModules('bodyleft') and $this->countModules('bodyright') ){
	$bodysidebar = array(
		'',
		'col-md-8',
		'col-md-3'
	);
}

//bodysidebar - 0 position
if(  !$this->countModules('bodyleft') and !$this->countModules('bodyright') ){
	$bodysidebar = array(
		'',
		'col-md-12',
		''
	);
}

/****************************** showcase 1 ******************************/

// showcase - 3 positions
if( $this->countModules('showcase-a') and $this->countModules('showcase-b') and $this->countModules('showcase-c') ){
    $showcase = 'col-md-4';
}

// showcase - 2 positions
if( $this->countModules('showcase-a') and $this->countModules('showcase-b') and !$this->countModules('showcase-c') ){
    $showcase = 'col-md-6';
}
if( $this->countModules('showcase-a') and !$this->countModules('showcase-b') and $this->countModules('showcase-c') ){
    $showcase = 'col-md-6';
}
if( !$this->countModules('showcase-a') and $this->countModules('showcase-b') and $this->countModules('showcase-c') ){
    $showcase = 'col-md-6';
}

// showcase - 1 position
if( $this->countModules('showcase-a') and !$this->countModules('showcase-b') and !$this->countModules('showcase-c') ){
    $showcase = 'col-md-12';
}
if( !$this->countModules('showcase-a') and $this->countModules('showcase-b') and !$this->countModules('showcase-c') ){
    $showcase = 'col-md-12';
}
if( !$this->countModules('showcase-a') and !$this->countModules('showcase-b') and $this->countModules('showcase-c') ){
    $showcase = 'col-md-12';
}

/****************************** showcase 2 ******************************/

// showcase2 - 3 positions
if( $this->countModules('showcase-d') and $this->countModules('showcase-e') and $this->countModules('showcase-f') ){
    $showcase2 = 'col-md-4';
}

// showcase2 - 2 positions
if( $this->countModules('showcase-d') and $this->countModules('showcase-e') and !$this->countModules('showcase-f') ){
    $showcase2 = 'col-md-6';
}
if( $this->countModules('showcase-d') and !$this->countModules('showcase-e') and $this->countModules('showcase-f') ){
    $showcase2 = 'col-md-6';
}
if( !$this->countModules('showcase-d') and $this->countModules('showcase-e') and $this->countModules('showcase-f') ){
    $showcase2 = 'col-md-6';
}

// showcase2 - 1 position
if( $this->countModules('showcase-d') and !$this->countModules('showcase-e') and !$this->countModules('showcase-f') ){
    $showcase2 = 'col-md-12';
}
if( !$this->countModules('showcase-d') and $this->countModules('showcase-e') and !$this->countModules('showcase-f') ){
    $showcase2 = 'col-md-12';
}
if( !$this->countModules('showcase-d') and !$this->countModules('showcase-e') and $this->countModules('showcase-f') ){
    $showcase2 = 'col-md-12';
}

/****************************** bottom 1 ******************************/

// bottom - 4 positions
if(  $this->countModules('bottom-a') and $this->countModules('bottom-b') and $this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-3';
}

// bottom - 3 positions
if(  $this->countModules('bottom-a') and $this->countModules('bottom-b') and $this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-4';
}
if(  $this->countModules('bottom-a') and $this->countModules('bottom-b') and !$this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-4';
}
if(  $this->countModules('bottom-a') and !$this->countModules('bottom-b') and $this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-4';
}
if(  !$this->countModules('bottom-a') and $this->countModules('bottom-b') and $this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-4';
}

// bottom - 2 positions
if(  $this->countModules('bottom-a') and $this->countModules('bottom-b') and !$this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}
if(  $this->countModules('bottom-a') and !$this->countModules('bottom-b') and $this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}
if(  $this->countModules('bottom-a') and !$this->countModules('bottom-b') and !$this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}
if(  !$this->countModules('bottom-a') and $this->countModules('bottom-b') and $this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}
if(  !$this->countModules('bottom-a') and $this->countModules('bottom-b') and !$this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}
if(  !$this->countModules('bottom-a') and !$this->countModules('bottom-b') and $this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-6';
}

// bottom - 1 position
if(  $this->countModules('bottom-a') and !$this->countModules('bottom-b') and !$this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-12';
}
if(  !$this->countModules('bottom-a') and $this->countModules('bottom-b') and !$this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-12';
}
if(  !$this->countModules('bottom-a') and !$this->countModules('bottom-b') and $this->countModules('bottom-c') and !$this->countModules('bottom-d') ){
    $bottom = 'col-md-12';
}
if(  !$this->countModules('bottom-a') and !$this->countModules('bottom-b') and !$this->countModules('bottom-c') and $this->countModules('bottom-d') ){
    $bottom = 'col-md-12';
}

//nothing - default
if(  empty($bottom)  ){
    $bottom = 'col-md-12';
}

/****************************** bottom 2 ******************************/

// bottom2 - 4 positions
if(  $this->countModules('bottom-e') and $this->countModules('bottom-f') and $this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-3';
}

// bottom2 - 3 positions
if(  $this->countModules('bottom-e') and $this->countModules('bottom-f') and $this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-4';
}
if(  $this->countModules('bottom-e') and $this->countModules('bottom-f') and !$this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-4';
}
if(  $this->countModules('bottom-e') and !$this->countModules('bottom-f') and $this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-4';
}
if(  !$this->countModules('bottom-e') and $this->countModules('bottom-f') and $this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-4';
}

// bottom2 - 2 positions
if(  $this->countModules('bottom-e') and $this->countModules('bottom-f') and !$this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}
if(  $this->countModules('bottom-e') and !$this->countModules('bottom-f') and $this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}
if(  $this->countModules('bottom-e') and !$this->countModules('bottom-f') and !$this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}
if(  !$this->countModules('bottom-e') and $this->countModules('bottom-f') and $this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}
if(  !$this->countModules('bottom-e') and $this->countModules('bottom-f') and !$this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}
if(  !$this->countModules('bottom-e') and !$this->countModules('bottom-f') and $this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-6';
}

// bottom2 - 1 position
if(  $this->countModules('bottom-e') and !$this->countModules('bottom-f') and !$this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-12';
}
if(  !$this->countModules('bottom-e') and $this->countModules('bottom-f') and !$this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-12';
}
if(  !$this->countModules('bottom-e') and !$this->countModules('bottom-f') and $this->countModules('bottom-g') and !$this->countModules('bottom-h') ){
    $bottom2 = 'col-md-12';
}
if(  !$this->countModules('bottom-e') and !$this->countModules('bottom-f') and !$this->countModules('bottom-g') and $this->countModules('bottom-h') ){
    $bottom2 = 'col-md-12';
}
//nothing - default
if(  empty($bottom2) ){
    $bottom2 = 'col-md-12';
}

/****************************** footer ******************************/

// footer - 4 positions
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-3';
}

// footer - 3 positions
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-4';
}
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-4';
}
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-4';
}
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-4';
}

// footer - 2 positions
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-6';
}
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-6';
}
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and !$this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-6';
}
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-6';
}
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-6';
}
if(  !$this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-6';
}

// footer - 1 position
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and !$this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-12';
}
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-12';
}
if(  !$this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') and !$this->countModules('footer-d') ){
    $footer = 'col-md-12';
}
if(  !$this->countModules('footer-a') and !$this->countModules('footer-b') and !$this->countModules('footer-c') and $this->countModules('footer-d') ){
    $footer = 'col-md-12';
}
//nothing - default
if(  empty($footer) ){
    $footer = 'col-md-12';
}