<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/substitution-modern.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="ms-overlay">

    <div class="ms-card">

        <div class="ms-title">

            PLAYER SUBSTITUTION

        </div>

        <div class="ms-content">

            <div class="ms-player ms-in">

                <span class="ms-icon">+</span>

                <div>

                    <small>COMING IN</small>

                    <strong>Player Name</strong>

                </div>

            </div>

            <div class="ms-divider"></div>

            <div class="ms-player ms-out">

                <span class="ms-icon">−</span>

                <div>

                    <small>GOING OUT</small>

                    <strong>Player Name</strong>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>