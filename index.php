<?php 
session_start();

if (!isset($_SESSION['token'])) {
    header('Location: login.php');
} else { ?>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="table-title">
        <h3>Select Products</h3>
        <select class="custom-select" id="select_product"></select>
        <h5>Data Variants Product</h5>
        <table id="table_variant" class="table-fill">
            <thead>
                <tr>
                    <th class="text-center">Variant ID</th>
                    <th class="text-center">Variant Title</th>
                    <th class="text-center">Quantity</th>
                </tr>
            </thead>
            <tbody id="variant_body"></tbody>
        </table>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'functions/products.php',
            success: function(response) {
                if (response) {
                    var res = JSON.parse(response);
                    $('#select_product').append($('<option>', {
                            value: '0',
                            text: '-- Choose a Products --'
                        }));
                    $.each(res.products, function(k,v) {
                        $('#select_product').append($('<option>', {
                            value: v.id,
                            text: v.title
                        }));
                    })
                } else {
                    window.location.reload();
                }
            }
        })

        $('#select_product').on('change', function(e) {
            var id = $(this).val();
            $.ajax({
                url: 'functions/products.php',
                success: function(response) {
                    if (response) {
                        $('#variant_body').html('');
                        var res = JSON.parse(response);
                        $.each(res.products, function(k,v) {
                            if (id == v.id) {
                                $.each(v.variants, function(k1,v1) {
                                    var v_body = '';
                                    if (v1.inventory_quantity < 3) {
                                        v_body += '<tr style="background:#FF9B9B;"><td>'+v1.id+'</td><td>'+v1.title+'</td><td class="text-center">'+v1.inventory_quantity+'</td></tr>';
                                    } else if (v1.inventory_quantity > 3 && v1.inventory_quantity < 10 ) {
                                        v_body += '<tr style="background:#F7D060;"><td>'+v1.id+'</td><td>'+v1.title+'</td><td class="text-center">'+v1.inventory_quantity+'</td></tr>';
                                    } else {
                                        v_body += '<tr><td>'+v1.id+'</td><td>'+v1.title+'</td><td class="text-center">'+v1.inventory_quantity+'</td></tr>';
                                    }
                                    $('#variant_body').append(v_body)
                                })
                            }
                            if (id == 0) {
                                $('#variant_body').html('');
                            }
                        })
                    } else {
                        window.location.reload();
                    }
                }
            })
            e.preventDefault();
        })
    })
</script>
</html>
<?php } ?>
