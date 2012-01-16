<?php
if (isset($_POST['p'])) {
    exec(__DIR__ . '/../lib/USBMailNotifierCmd.exe -P '.escapeshellarg($_POST['p']));
} elseif (isset($_POST['r']) && isset($_POST['g']) && isset($_POST['b'])) {
    exec(__DIR__ . '/../lib/USBMailNotifierCmd.exe -C '.escapeshellarg($_POST['r']).' '.escapeshellarg($_POST['g']).' '.escapeshellarg($_POST['b']));
} else { ?>
    <!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Mail Notifier Frontend</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="Michael Kliewe, Germany" />
        <meta name="robots" content="index, follow, noarchive" />
        <meta name="keywords" lang="de" content="usb mail notifier" />
        <meta name="description" lang="de" content="" />

        <link rel="stylesheet" type="text/css" media="screen, projection" href="css/slider.css" />

        <!--  http://www.frequency-decoder.com/demo/slider-v2/  -->
        <script type="text/javascript" src="js/slider.min.js"></script>
        <script type="text/javascript" src="js/mootools-core-1.4.2-full-nocompat-yc.js"></script>
    </head>
    <body>
        <div style="width: 300px;">
            <h3>Farbe setzen</h3>
            <div>
                <label for="red" class="lft">Rot</label>
                <input name="red" id="red" type="text" title="Range: 0 - 64" class="fd_slider fd_tween fd_range_0_64 fd_slider_cb_update_updateColor" value="0"  maxlength="3" style="display: none;"/>
            </div>
            <div>
                <label for="green" class="lft">Grün</label>
                <input name="green" id="green" type="text" title="Range: 0 - 64" class="fd_slider fd_tween fd_range_0_64 fd_slider_cb_update_updateColor" value="0"  maxlength="3" style="display: none;"/>
            </div>
            <div>
                <label for="blue" class="lft">Blau</label>
                <input name="blue" id="blue" type="text" title="Range: 0 - 64" class="fd_slider fd_tween fd_range_0_64 fd_slider_cb_update_updateColor" value="0"  maxlength="3" style="display: none;"/>
            </div>
        </div>
        <div style="width: 300px; margin-top: 20px;">
            <h3>Pulsieren</h3>
            <div>
                <label for="pulsecount" class="lft">Anzahl</label>
                <input name="pulsecount" id="pulsecount" type="text" title="Range: 1 - 10" class="fd_slider fd_tween fd_range_1_10" value="5"  maxlength="1" style="display: none;"/>
            </div>
            <input type="button" id="pulseButton" value="Pulse!">
        </div>
        <div style="width: 300px; margin-top: 20px;">
            <h3>Power</h3>
            <input type="button" id="poweroff" value="Ausschalten">
        </div>


        <script type="text/javascript">
            $('pulseButton').addEvent('click', function() {
                new Request({
                    method: 'post',
                    url: 'index.php',
                    data:'p='+$('pulsecount').value
                }).send();
            });

            $('poweroff').addEvent('click', function() {
                new Request({
                    method: 'post',
                    url: 'index.php',
                    data:'r=0&g=0&b=0'
                }).send();
            });

            var timeoutId;

            function updateColor() {
                if (timeoutId) {
                    clearTimeout(timeoutId);
                }

                var reqFunction = function() {
                    var pollRequest = new Request({
                        method: 'post',
                        url: 'index.php',
                        data:'r='+$('red').value+'&g='+$('green').value+'&b='+$('blue').value
                    }).send();
                };

                timeoutId = reqFunction.delay(50);

            }
        </script>
    </body>
    </html>
<? } ?>