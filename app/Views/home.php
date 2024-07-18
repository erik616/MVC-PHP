<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Businesses</title>
    <link rel="stylesheet" href="../../public/assets/css/styles.css">
</head>

<body>
    <section>
        <header>
            <nav>
                <p>Bem-vindo ao My Businesses</p>
            </nav>
        </header>
        <main>
            <section class="form">
                <div class="modal none">
                    <p>
                        Verifique se os campos foram preenchidos corretamente
                    </p>
                </div>
                <h3>Criar boleto:</h3>
                <form action="/create-bill" method="post">
                    <div class="row">
                        <select name="company" id="companies">
                            <option hidden selected>Empresas</option>
                            <?php foreach ($companys as $item) { ?>
                                <option value=<?php echo $item['id_empresa'] ?>><?php echo $item['nome'] ?></option>
                            <?php } ?>
                        </select>

                        <input name="date" type="date" id="date">
                    </div>

                    <span id="input_price">
                        <p>R$</p>
                        <input type="text" name="price" class="price" placeholder="00,00">
                    </span>

                    <button type="button">Adicionar</button>
                </form>
            </section>

            <article>

                <header>
                    <h3>Buscar por boleto</h3>
                    <form action="/home/filter" method="post">

                        <span class="price_select">
                            <select name="operation" id="operation">
                                <option value=">">Maior</option>
                                <option value="<">Menor</option>
                                <option value="=">Igual</option>
                            </select>

                            <span id="input_price">
                                <p>R$</p>
                                <input type="text" name="price" class="price" placeholder="00,00">
                            </span>
                        </span>

                        <input name="date" type="date" id="date">

                        <select name="company" id="companies">
                            <option hidden selected>Empresas</option>
                            <?php foreach ($companys as $item) { ?>
                                <option value=<?php echo $item['id_empresa'] ?>><?php echo $item['nome'] ?></option>
                            <?php } ?>
                        </select>

                        <button type="submit">Buscar</button>
                    </form>
                </header>

                <table class="square_table">
                    <thead>
                        <tr class="header_table">
                            <th>Empresa</th>
                            <th>Gasto</th>
                            <th>Data</th>
                            <th>Debitada</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($bills) < 1) : ?>
                            <tr class="row_table">
                                <td>Ainda não há nenhum boleto!</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($bills as $item) : ?>
                                <?php if ($item['pago']) : ?>
                                    <tr class="row_table pay">
                                    <?php else : ?>
                                    <tr class="row_table">
                                    <?php endif ?>
                                    <td><?= $item['empresa'] ?></td>
                                    <td>R$ <?= str_replace(".", ",", $item['valor']) ?></td>
                                    <td><?= $item['data_pagar'] ?></td>
                                    <td><?= ($item['pago']) ? 'Sim' : 'Não' ?></td>
                                    <td class="actions">
                                        <?php if (!$item['pago']) : ?>
                                            <button type="button" class="button pay" data-id=<?= $item['id_conta_pagar'] ?>>
                                                <img src="../../public/assets/img/pay.svg" alt="">
                                            </button>
                                        <?php else : ?>
                                            <button type="button" class="button disable">
                                                <img src="../../public/assets/img/pay.svg" alt="">
                                            </button>
                                        <?php endif ?>
                                        <button type="button" class="button edit" data-id=<?= $item['id_conta_pagar'] ?>>
                                            <img src="../../public/assets/img/edit.svg" alt="">
                                        </button>
                                        <button type="button" class="button delete" data-id=<?= $item['id_conta_pagar'] ?>>
                                            <img src="../../public/assets/img/delete.svg" alt="">
                                        </button>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif ?>
                    </tbody>

                </table>

                <div class="modal_update none">
                    <form action="" method="post">
                        <h1>Atualizar boleto <p></p>
                        </h1>

                        <input name="date" type="date" id="date">

                        <span id="input_price">
                            <p>R$</p>
                            <input type="text" name="price" class="price" placeholder="00,00">
                        </span>

                        <button type="button">Atualizar</button>
                    </form>
                </div>
            </article>
        </main>
    </section>

    <script src="../../public/assets/scripts/index.js"></script>
    <script src="../../public/assets/scripts/main.js"></script>
    <script src="../../public/assets/scripts/script.js"></script>
</body>

</html>