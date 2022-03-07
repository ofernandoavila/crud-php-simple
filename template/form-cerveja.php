<!-- Checa qual a finalidade do formulário (se é para deletar, editar ou criar uma cerveja) -->
<?php if (isset($data['action']) && $data['action'] == 'deletar') : ?>
    <div class="row">
        <form action="" method="post">
            <p>Tem certeza que deseja deletar '<b><?= $data['nome'] ?></b>' ?</p>
            <input type="submit" name="<?= $data['action']; ?>" class="btn btn-lg btn-danger btn-block" value="<?= $data['label']; ?>">
        </form>
    </div>
<?php else : ?>
    <!-- Esta parte serve para renderizar o formulário de criação, a variável '$data' é de onde vem os dados para serem editados -->
    <div class="row col-8">
        <form action="" method="post">
            <input type="text" name="nome" class="form-control mb-3" placeholder="Nome da cerveja" value="<?= isset($data) ? $data['nome'] : ''; ?>">
            <input type="text" name="marca" class="form-control mb-3" placeholder="Marca da cerveja" value="<?= isset($data) ? $data['marca'] : ''; ?>">
            <div class="input-group mb-3">
                <span class="input-group-text">R$</span>
                <input type="number" name="preco" class="form-control" placeholder="Preço da cerveja" value="<?= isset($data) ? $data['FORMAT(preco,2)'] : ''; ?>">
            </div>
            <!-- Realiza a checagem de qual tipo de ação irá realizar (se é para editar ou cadastrar uma cerveja) -->
            <input type="submit" name="<?= isset($data) ? $data['action'] : 'cadastrar'; ?>" class="btn btn-lg btn-primary btn-block" value="<?= isset($data) ? $data['label'] : 'Cadastrar'; ?>">
        </form>
    </div>
<?php endif; ?>