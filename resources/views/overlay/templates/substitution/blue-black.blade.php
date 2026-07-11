<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/substitution-blue-black.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="bbs-overlay">

    <div class="bbs-card">

        <div class="bbs-header">

            SUBSTITUTION

        </div>

        <div class="bbs-body">

            <div class="bbs-player bbs-in">

                <span class="bbs-arrow">↑</span>

                <div>

                    <small>PLAYER IN</small>

                    <strong>Player Coming In</strong>

                </div>

            </div>

            <div class="bbs-player bbs-out">

                <span class="bbs-arrow">↓</span>

                <div>

                    <small>PLAYER OUT</small>

                    <strong>Player Going Out</strong>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>