<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "{{ url() }}/css/swagger-ui.css" />
    <style>
        html
        {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }

        *,
        *:before,
        *:after
        {
            box-sizing: inherit;
        }

        body
        {
            margin:0;
            background: #fafafa;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="{{ url() }}/js/swagger-ui-bundle.js"></script>
<script src="{{ url() }}/js/swagger-ui-standalone-preset.js"></script>
<script>
    window.onload = function() {
        // Begin Swagger UI call region
        var spec = {!! $spec !!};
        // End Swagger UI call region

        window.ui = SwaggerUIBundle({
            spec: spec,
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                // the 'slice' is a workaround to remove the 'explore' Topbar plugin
                SwaggerUIStandalonePreset.slice(1)
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        })
    }
</script>
</body>
</html>
