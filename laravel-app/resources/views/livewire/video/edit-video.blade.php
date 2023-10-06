@if( $video->processed )
    <div>
@else
    <div wire:poll >
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if( ! $video->processed )
                            <div class="row">
                                <p>Processing ({{$this->video->processed_percentage}})</p>
                            </div>
                        @endif
                        <div class="row">
                            @if($this->video->thumbnail)
                                <img src="{{ asset($this->video->thumbnail)}}" class="img-preview mb-4" alt="Preview image">
                            @endif
                        </div>
                        <form wire:submit.prevent="update">
                            <div class="form-group mb-2">
                                <label for="title">Tile</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('video.title')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="description">Description</label>
                                <textarea cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                @error('video.description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="visibility">Visibility</label>
                                <select wire:model="visibility" class="form-control">
                                    @foreach(\App\Models\Video::VISIBILITY as $vkey => $vvalue)
                                        <option value="{{ $vkey }}">{{ $vvalue }}</option>
                                    @endforeach
                                </select>
                                @error('video.visibility')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <button
                                   type="submit"
                                   class="btn btn-primary"
                                   wire:loading.attr="disabled"
                                   >
                                    Update
                                </button>
                                <div wire:dirty wire:loading.remove>Unsaved changes...</div>
                                <div wire:loading>
                                    Saving...
                                </div>
                            </div>

                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message')}}
                                </div>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
