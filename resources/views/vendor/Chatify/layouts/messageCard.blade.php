<?php
$timeago = \Carbon\Carbon::parse($timeAgo)
    ->locale('id_ID')
    ->diffForHumans();
$seenIcon = !!$seen ? 'check-double' : 'check';
$timeAndSeen =
    "<span data-time='$created_at' class='message-time'>
        " .
    ($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '') .
    " <span class='time'>$timeago</span>
    </span>";
?>

<style>
    @media(max-width:455px) {
        .video {
            max-width: 220px;
        }
    }
</style>
<div class="message-card @if ($isSender) mc-sender @endif" data-id="{{ $id }}">
    {{-- Delete Message Button --}}
    @if ($isSender)
        <div class="actions">
            <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
        </div>
    @endif
    {{-- Card --}}
    <div class="message-card-content">
        @if (@$attachment->type != 'image' || $message)
            <div class="message">
                {!! $message == null && $attachment != null && @$attachment->type != 'file'
                    ? $attachment->title
                    : nl2br($message) !!}
                {!! $timeAndSeen !!}
                {{-- If attachment is a file --}}
                @if (isset($attachment->file))
                    @php
                        $extension = pathinfo($attachment->file, PATHINFO_EXTENSION);
                        $videoExtension = ['mp4', 'mkv', 'avi'];
                    @endphp
                    @if (in_array(strtolower($extension), $videoExtension))
                        <video class="video" controls width="fit-content" height="210px">
                            <source src="/storage/attachments/{{ $attachment->file }}" type="video/mp4">
                        </video>
                        <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) }}"
                            class="file-download" style="color:rgb(0, 0, 0);">
                            {{ $attachment->title }}</a>
                    @elseif(in_array(strtolower($extension), ['mp3']))
                        <audio style="margin-left:9%; margin-top:1%;" controls>
                            <source src="/storage/attachments/{{ $attachment->file }}" type="audio/mp3">
                        </audio>
                        <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) }}"
                            class="file-download" style="color: rgb(0, 0, 0);">
                            {{ $attachment->title }}</a>
                    @else
                        <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) }}"
                            class="file-download" style="color: rgb(0, 0, 0);">
                            <i class="fas fa-file"></i>
                            {{ $attachment->title }}</a>
                    @endif
                @endif
            </div>

        @endif
        @if (@$attachment->type == 'image')
            <div class="message">
                <img src="{{ asset('storage/attachments/' . $attachment->file) }}" alt="">
                <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) }}"
                    class="file-download" style="color: rgb(0, 0, 0);">
                    <i class="fas fa-file"></i>
                    {{ $attachment->title }}</a>
                <div style="margin-bottom:5px">
                    {!! $timeAndSeen !!}
                </div>
            </div>
        @endif

    </div>
</div>
