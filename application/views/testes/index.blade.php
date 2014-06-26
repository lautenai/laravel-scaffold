<div class="span12">
	<h3>Testes</h3>
@if(count($testes->results) == 0)
	<a class="btn btn-primary" href="{{ URL::to('testes/adicionar') }}">Adicionar Teste</a>
@else
	{{ Form::open('testes/checkbox', 'post', array('id' => 'form', 'autocomplete' => 'off')) }}
	<table id="testes" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><input type="checkbox" id="todos"/></th>
				<th>NOME</th>
				<th><span class="badge pull-right">{{$testes->total}}</span></th>
			</tr>
		</thead>
		<tbody>
		@foreach($testes->results as $teste)
			<tr>
				<td width="5px"><input class="checkbox" name="checkbox[]" type="checkbox" value="{{ $teste->id }}"></td>
				<td>{{ $teste->nome }}</td>
				<td class="dr-fxwidth">
					<a href="{{ URL::to('testes/exibir/'.$teste->id) }}" class="icon-eye-open icon-large icon-black"></a>
					<a href="{{ URL::to('testes/editar/'.$teste->id) }}" class="icon-pencil icon-large icon-black"></a>
					<a href="{{ URL::to('testes/excluir/'.$teste->id) }}" class="icon-trash icon-large icon-black" onclick="return confirm('Voce tem certeza que deseja excluir este item?')"></a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{{ $testes->links() }}

	<a class="btn btn-primary" href="{{ URL::to('testes/adicionar') }}">Adicionar Teste</a>
	<input class="btn btn-danger" type="submit" value="Delete" name="Delete" />
	{{ Form::close()}}
@endif
</div>
<script type="text/javascript">$(document).ready(function(){$("#todos").click(function(e){if(this.checked){$(".checkbox").each(function(){this.checked=true})}else{$(".checkbox").each(function(){this.checked=false})}})})</script>
<script type="text/javascript">Mousetrap.bind('+', function() { window.location.href = '{{ URL::to('testes/adicionar') }}'; });</script>