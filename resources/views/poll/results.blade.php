<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $poll->title }} - Results</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .description {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .total-votes {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #555;
        }

        .result-item {
            margin-bottom: 25px;
        }

        .result-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .option-text {
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .vote-count {
            color: #666;
            font-size: 14px;
        }

        .progress-bar {
            background: #e0e0e0;
            height: 40px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: width 0.8s ease-out;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 15px;
            width: 0;
        }

        .percentage {
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .back-link:hover {
            background: #764ba2;
        }

        .no-votes {
            text-align: center;
            color: #999;
            padding: 40px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $poll->title }}</h1>
        <p class="description">{{ $poll->description }}</p>

        <div class="total-votes">
            Total Votes: {{ $totalVotes }}
        </div>

        @if($totalVotes > 0)
            @foreach($options as $option)
                @php
                    $percentage = $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100, 1) : 0;
                @endphp
                <div class="result-item">
                    <div class="result-header">
                        <span class="option-text">{{ $option->option_text }}</span>
                        <span class="vote-count">{{ $option->votes_count }} {{ Str::plural('vote', $option->votes_count) }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" data-width="{{ $percentage }}">
                            <span class="percentage">{{ $percentage }}%</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-votes">
                No votes have been cast yet. Be the first to vote!
            </div>
        @endif

        <a href="{{ route('poll.show', $poll->id) }}" class="back-link">← Back to Poll</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-fill');
            setTimeout(function() {
                progressBars.forEach(function(bar) {
                    const width = bar.getAttribute('data-width');
                    bar.style.width = width + '%';
                });
            }, 100);
        });
    </script>
</body>
</html>
