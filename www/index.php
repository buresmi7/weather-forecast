
<?php
    $serviceLocator = require(__DIR__ . '/../app/bootstrap.php');
    
    $repository = $serviceLocator->getRepository();

    $items = $repository->getAll();

    $options = '<option value="">Select</option>';
    foreach($items as $item) { 
        $options .= '<option value="' . $item['date'] . '">' . $item['date'] . '</option>';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Forecast Prague</h1>
        <select id="selectDate">
            <?= $options ?>
        </select>

        <p>Minimal: <span id="min">-</span> &deg;C</p>
        <p>Maximal: <span id="max">-</span> &deg;C</p>

        <a href="https://www.yahoo.com/?ilc=401" target="_blank"> <img src="https://poweredby.yahoo.com/purple.png" width="134" height="29"/> </a>

        <script src="assets/jquery-3.2.1.min.js"></script>
        <script>
            $('#selectDate').on('change', function() {
                function setValues(min, max) {
                    $('#min').text(min);
                    $('#max').text(max);
                }

                function resetValues() {
                    setValues('-', '-');
                }

                var selectedValue = this.value;
                $.ajax({
                    url: 'getData.php',
                    data: {
                        selectedValue: selectedValue
                    },
                    type: 'GET',
                    success: function(data) {
                       setValues(data.item.min, data.item.max);
                    },
                    error: function() {
                        setValues('err', 'err');
                    }
                });
            });
        </script>
    </body>
</html>