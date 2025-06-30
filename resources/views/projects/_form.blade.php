@csrf

@if($project->image)

<img class="card-img-top mb-3"
        style="height: 250px; object-fit: cover;" 
        src="/storage/{{ $project->image }}" 
        alt="{{ $project->title }}">

@endif

<div class="mb-3">
        <label for="image" class="form-label">Imagen</label>
        <input class="form-control form-control-sm bg-light shadow-sm"
                id="image"
                type="file"
                name="image">
</div>

<div class="mb-3">
        <label for="title" class="form-label">Titulo del proyecto</label>
        <input class="form-control bg-light shadow-sm @error('title') is-invalid @else border-0 @enderror"
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $project->title) }}">
</div>

<div class="mb-3">
        <label for="url" class="form-label">Url del proyecto</label>
        <input class="form-control bg-light shadow-sm @error('url') is-invalid @else border-0 @enderror"
                type="text"
                id="url"
                name="url"
                value="{{ old('url', $project->url) }}">
</div>


<div class="mb-3">
        <label for="description" class="form-label">Descripción del proyecto</label>
        <textarea class="form-control bg-light shadow-sm @error('description') is-invalid @else border-0 @enderror"
                id="description"
                name="description">{{ old('description', $project->description) }}
        </textarea>
</div>

<div class="mb-3">
        <label for="category_id" class="form-label">Categoría del proyecto</label>
        <select class="form-select" name="category_id" id="category_id">
                <option value="">Seleccione</option>
                @foreach ($categories as $id => $name)
                        <option value="{{$id}}"
                        @if($id == old('category_id', $project->category_id)) selected @endif>
                        {{$name}}
                        </option>
                @endforeach
        </select>
</div>