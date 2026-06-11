<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>presenZ Falco - API Documentation</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        
        /* Premium Header Styling */
        .swagger-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-bottom: 1px solid #334155;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .back-btn {
            background-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .back-btn:hover {
            background-color: white;
            color: #0f172a;
        }

        /* Swagger Container Customization */
        #swagger-ui {
            padding: 20px 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Make standard swagger look elegant and neat */
        .swagger-ui .topbar {
            display: none !important;
        }
        
        .swagger-ui .scheme-container {
            background: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03) !important;
            border-radius: 12px;
            padding: 20px !important;
            border: 1px solid #e2e8f0;
        }
        
        .swagger-ui .opblock {
            border-radius: 8px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02) !important;
        }
    </style>
</head>
<body>
    <header class="swagger-header">
        <div class="logo-area">
            <div class="logo-icon">F</div>
            <span class="logo-text">presenZ Falco API</span>
        </div>
        <a href="/dashboard" class="back-btn">← Kembali ke Dashboard</a>
    </header>

    <div id="swagger-ui"></div>

    <script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-standalone-preset.js"></script>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "/openapi.json",
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "BaseLayout"
            });
            window.ui = ui;
        };
    </script>
</body>
</html>
