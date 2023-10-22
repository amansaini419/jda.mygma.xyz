<div>
    <form wire:submit="voterLogin">
        <div class="mb-3">
            <input type="text" placeholder="MDC Number" wire:model="mdcNumber" class="form-control form-control-lg rounded-pill text-center @error('mdcNumber') is-invalid @enderror" />
            @error('mdcNumber')<p class="text-error m-0">{{ $message }}</p>@enderror
        </div>
        @if($loginSuccess)
        <div class="mb-3">
            <input type="text" placeholder="2FA Code" wire:model="confirmCode" class="form-control form-control-lg rounded-pill text-center @error('confirmCode') is-invalid @enderror" />
            @error('confirmCode')<p class="text-error m-0">{{ $message }}</p>@enderror
            <a href="javascript:;" class="text-end" wire:click="resendCode">Resend Code</a>
        </div>
        @endif
        <div class="d-grid m-0">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill text-uppercase fw-medium">login</button>
        </div>
    </form>
</div>
