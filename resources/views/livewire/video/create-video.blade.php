<div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"
                     x-data="{ isUploading: false, progress: 0 }"
                     x-on:livewire-upload-start="isUploading = true"
                     x-on:livewire-upload-finish="isUploading = false , $wire.fileCompleted()"
                     x-on:livewire-upload-error="isUploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="card-header"><h1>Add new video</h1></div>
                    <div class="card-body">
                        <div class="progress my-4" x-show="isUploading">
                            <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`"></div>
                        </div>
                        <form x-show="!isUploading">
                            <div class="form-group">
                                <label>Select a video file to upload</label>
                                <input type="file" accept="video/mp4" wire:model='videoFile' class="form-control @error('videoFile') is-invalid @enderror">
                                @error('videoFile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
