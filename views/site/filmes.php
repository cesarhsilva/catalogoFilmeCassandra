<?php
$this->title = 'Filmes';
?>

<div class="site-index" style="margin-top:50px;">
	<h2>Lista de Filmes</h2>

	<div>
		<table class="table table table-striped">
			<thead>
				<tr>
					<th scope="col">Nome</th>
					<th scope="col">Ano</th>
					<th scope="col">Quantidade</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listaFilmes as $filme) :?>
					<tr>
						<td><?php echo $filme->nome; ?></td>
						<td><?php echo $filme->ano; ?></td>
						<td><?php echo $filme->copias; ?></td>
					</tr>
				<?php endforeach;?>
			<tbody>
		</table>
	</div>
</div>
