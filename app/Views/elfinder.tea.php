<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>elFinder 2.1.x source version with PHP connector</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />

		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="./main.default.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				// elFinder options (REQUIRED)
				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : 'php/connector.minimal.php' // connector URL (REQUIRED)
					,commandsOptions : {
						edit : {
							extraOptions : {
								// set API key to enable Creative Cloud image editor
								// see https://console.adobe.io/
								creativeCloudApiKey : '',
								// browsing manager URL for CKEditor, TinyMCE
								// uses self location with the empty value
								managerUrl : ''
							}
						}
						,quicklook : {
							// to enable preview with Google Docs Viewer
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
						}
					}
					// bootCalback calls at before elFinder boot up 
					,bootCallback : function(fm, extraObj) {
						/* any bind functions etc. */
						fm.bind('init', function() {
							// any your code
						});
						// for example set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					}
				},
				managers : {
					// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
