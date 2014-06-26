<div class="span12">
	<h3><?php echo str_replace('_', ' ', $plural_class); ?></h3>
@if(count($<?php echo $plural; ?>->results) == 0)
	<a class="btn btn-primary" href="{{ URL::to('<?php echo $nested_path.$plural; ?>/adicionar') }}">Adicionar <?php echo str_replace('_', ' ', $singular_class); ?></a>
@else
	{{ Form::open('<?php echo $plural; ?>/checkbox', 'post', array('id' => 'form', 'autocomplete' => 'off')) }}
	<table id="<?php echo $plural; ?>" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><input type="checkbox" id="todos"/></th>
<?php foreach($fields as $field => $type): ?>
<?php $field = (strpos($field, '_id') !== false ? substr($field, 0,-2) : $field); ?>
				<th><?php echo strtoupper(str_replace('_', ' ', $field)); ?></th>
<?php endforeach; ?>
<?php foreach($plural_relationships as $type => $models): ?><?php foreach($models as $model): ?>
				<th><?php echo strtoupper(str_replace('_', ' ', Str::plural($model))); ?></th>
<?php endforeach; ?>
<?php endforeach; ?>
				<th><span class="badge pull-right">{{$<?php echo $plural; ?>->total}}</span></th>
			</tr>
		</thead>
		<tbody>
		@foreach($<?php echo $plural; ?>->results as $<?php echo $singular; ?>)
			<tr>
				<td width="5px"><input class="checkbox" name="checkbox[]" type="checkbox" value="{{ $<?php echo $singular; ?>->id }}"></td>
<?php foreach($fields as $field => $type): ?>
<?php if($type != 'boolean' AND $type != 'date'): ?>
<?php if(strpos($field, '_id') !== false && in_array($model = substr($field, 0, -3), $belongs_to)): ?>
				<td><a href="{{ URL::to('<?php echo $url[$model]; ?>/exibir/'.$<?php echo $singular; ?>->id) }}">{{ $<?php echo $singular; ?>-><?php echo $model; ?>->nome }}</a></td>
<?php else: ?>
				<td>{{ $<?php echo $singular; ?>-><?php echo $field; ?> }}</td>
<?php endif; ?>
<?php elseif($type == 'date'): ?>
				<td>{{ DateBR::toView($<?php echo $singular; ?>-><?php echo $field; ?>, 'date') }}</td>
<?php else: ?>
				<td>{{ ($<?php echo $singular; ?>-><?php echo $field; ?>) ? 'SIM' : 'NÃO' }}</td>
<?php endif; ?>
<?php endforeach; ?>
<?php foreach($plural_relationships as $type => $models): ?>
<?php foreach($models as $model): ?>
				<td>{{ count($<?php echo $singular; ?>-><?php echo Str::plural($model); ?>) }}</td>
<?php endforeach; ?>
<?php endforeach; ?>
				<td class="dr-fxwidth">
					<a href="{{ URL::to('<?php echo $nested_path.$plural; ?>/exibir/'.$<?php echo $singular; ?>->id) }}" class="icon-eye-open icon-large icon-black"></a>
					<a href="{{ URL::to('<?php echo $nested_path.$plural; ?>/editar/'.$<?php echo $singular; ?>->id) }}" class="icon-pencil icon-large icon-black"></a>
					<a href="{{ URL::to('<?php echo $nested_path.$plural; ?>/excluir/'.$<?php echo $singular; ?>->id) }}" class="icon-trash icon-large icon-black" onclick="return confirm('Voce tem certeza que deseja excluir este item?')"></a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{{ $<?php echo $plural; ?>->links() }}

	<a class="btn btn-primary" href="{{ URL::to('<?php echo $nested_path.$plural; ?>/adicionar') }}">Adicionar <?php echo str_replace('_', ' ', $singular_class); ?></a>
	<input class="btn btn-danger" type="submit" value="Delete" name="Delete" />
	{{ Form::close()}}
@endif
</div>
<script type="text/javascript">$(document).ready(function(){$("#todos").click(function(e){if(this.checked){$(".checkbox").each(function(){this.checked=true})}else{$(".checkbox").each(function(){this.checked=false})}})})</script>
<script type="text/javascript">Mousetrap.bind('+', function() { window.location.href = '{{ URL::to('<?php echo $nested_path.$plural; ?>/adicionar') }}'; });</script>