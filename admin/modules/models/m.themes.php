<?php

global $themes, $Globals;
$Globals->add("title", lang_s('_THEMES', true));
$Globals->add("menu_active", $controller);
$Themes = $themes->themes_installer();

$ThemesHtml = '';

if($Themes){



	$ThemesHtml = '
	
	<div class="separate_title">
	<span>' . lang_s('THEME_ACTIVE', true) . '</span>
	</div>
	
	<table class="preview-container-theme">
		
		<tr>
		<td class="thumbnail-container-theme">
			
			<div class="thumbnail-container-theme">
				<img src="'.$Themes[0]['themepreview'].'">
			</div>
			
		
		</td>
		<td>
			
			<div class="theme-header">
			<h3 class="theme-name">'.$Themes[0]['name'].'</h3>
			<span class="theme-version">'.lang_s('_VERSION',true).': '.$Themes[0]['version'].'</span>
			<span class="theme-author">'.lang_s('_BY', true).' <a href="'.$Themes[0]['authorUrl'].'" target="_blank">'.$Themes[0]['author'].'</a></span>
			</div>
			<span class="theme-description">'.$Themes[0]['description'].'</span>';
			
			if (get_lang_installer_theme($Themes[0]['tag'])){

				$ThemesHtml .= '<div class="controls">
					<a href="'.get_config("siteurl").'/admin/'.$controller.'/options/' . $Themes[0]['tag'].'" class="btn btn-default">' . lang_s('_OPTIONS', true) . '</a>
				</div>';			
			
			}
			
		$ThemesHtml .= '</div>
			
		</td>
		</tr>
	
	</table>';

$ThemesHtml .= '

<div class="separate_title">
<span>' . lang_s('THEMES_GALLERY', true) . '</span>
</div>

<table class="preview-container-theme">';



	foreach ($Themes as $key){
		
		if ($key['active'] !== true) {
		
			$ThemesHtml .= '<tr>
			<td class="thumbnail-container-theme">
			
				<div class="thumbnail-container-theme">
					<img src="'.$key['themepreview'].'">
				</div>
		
			</td>
			<td>
			
				<div class="theme-header">
				<h3 class="theme-name">'.$key['name'].'</h3>
				<span class="theme-version">'.lang_s('_VERSION',true).': '.$key['version'].'</span>
				<span class="theme-author">'.lang_s('_BY', true).' <a href="'.$key['authorUrl'].'" target="_blank">'.$key['author'].'</a></span>
				</div>
				<span class="theme-description">'.$key['description'].'</span>
			
				<div class="controls">
				<a href="'. get_config("siteurl").'/admin/'.$controller.'/activate/' . $key['tag'] .'" class="btn btn-primary">'. lang_s('_ACTIVATE', true) .'</a>';
				
				if (get_lang_installer_theme($key['tag'])){
				
					$ThemesHtml .= '<a href="'.get_config("siteurl").'/admin/'.$controller.'/options/' . $key['tag'].'" class="btn btn-default">' . lang_s('_OPTIONS', true) . '</a>';

				}
				
				
				
		$ThemesHtml .= '</div>
			</td>
			</tr>';
		
		}
	
	}
	
	
	
	$ThemesHtml .= '
</table>';
	
}

$Globals->add('ThemesHtml', $ThemesHtml);





