<?php 
require_once 'views/layout/header.php';
?>
<?php if (isset($_SESSION['identity'])): ?>
<h1 class="title" style="margin-top: 25px;">Categorias</h1>
<div id="filter-buttons" class="fila-grid configuracion-filtrador">
        <div class="filter active" data-filter="all">
            <p>Todos</p>
        </div>
        <div class="filter" data-filter="Favoritos⭐">
            <p>Favoritos⭐</p>
        </div>
    <?php while($cat = $categorias->fetch_object()): ?>
        <div class="filter" data-filter="<?=$cat->data_filter;?>">
            <p><?=$cat->categoria;?></p>
        </div>
    <?php endwhile; ?>
</div>
<h1 class="title">Recursos</h1>
<div id="resources" class="fila-grid configuracion">
    <?php while($recu = $recursos->fetch_object()): ?>
        <?php $favorito = ($recu->favorito == "SI") ? "Favoritos⭐" : ""; ?> 
        <div class="button <?=$favorito;?>" data-filtered="<?=$recu->clase;?>" data-id="<?=$recu->id;?>">
            <a href="<?=$recu->url;?>" target="_blank">
                <p>
                    <?=$recu->subcategoria;?>
                </p>
                <?php if($recu->favorito == "NO"): ?>
                    <img class="btn-fav" data-id="<?=$recu->id;?>" src="<?=base_url?>assets/img/nofavorito.svg">
                <?php elseif($recu->favorito == "SI"): ?>
                    <img class="btn-fav" data-id="<?=$recu->id;?>" src="<?=base_url?>assets/img/favorito.svg">
                <?php endif; ?>
            </a>
        </div>
    <?php endwhile; ?>
</div>
<?php else: ?>
    <?=header("Location:".base_url."inicio/index");?>
<?php endif; ?>
<script>
    $(document).ready(function () {
        $('#filter-buttons .filter').click(function (e) {
            e.preventDefault();
            let filter = $(this).data('filter');

            $('#filter-buttons .filter').removeClass('active');
            $(this).addClass('active');

            if (filter == 'all') {
                $('.button').show();
            } else {
                $('.button').hide();
                $('.button').filter(function() {
                    return $(this).data('filtered') === filter || $(this).hasClass(filter);
                }).show();
            }
        });

        $('.btn-fav').click(function (e) { 
            e.preventDefault();
            let id = $(this).data('id');
            let data = ($(this).attr('src').includes('nofavorito')) ? 'SI' : 'NO';
            let claseButton = $('.button[data-id="'+id+'"]');
            $.ajax({
                type: "POST",
                url: "<?=base_url?>recurso/favorito",
                data: {
                    data: data,
                    id: id
                },
                success: function (response) {
                    if (data === 'SI') {
                        $('.btn-fav[data-id="'+id+'"]').attr('src', '<?=base_url?>assets/img/favorito.svg');
                        claseButton.addClass('Favoritos⭐');
                    } else {
                        $('.btn-fav[data-id="'+id+'"]').attr('src', '<?=base_url?>assets/img/nofavorito.svg');
                        claseButton.removeClass('Favoritos⭐');
                    }
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
