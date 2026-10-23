<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f5f7fb">
    <title>Tasks | Focusboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="brand" href="{{ route('tasks.index') }}" aria-label="Focusboard home"><span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 4 4L19 6"/></svg></span><span class="brand-name">Focus<span>board</span></span></a>
            <a class="nav-link" href="{{ route('tasks.index') }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 12h18M12 3v18"/></svg><span>Task workspace</span></a>
        </header>
        <main class="main">
            <section class="intro"><div><div class="eyebrow">Your personal workspace</div><h1>Make room for<br>what matters.</h1><p class="subtitle">Capture your next step, keep your momentum, and see everything important at a glance.</p></div><div class="stat"><strong>{{ $tasks->count() }}</strong><span>{{ $tasks->count() === 1 ? 'task' : 'tasks' }} in your list</span></div></section>
            @if (session('success'))<div class="flash" role="status"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>{{ session('success') }}</div>@endif
            <section class="workspace">
                <div class="panel form-panel"><div class="panel-heading"><div><h2>Add a new task</h2><p>Turn an intention into your next action.</p></div><span class="plus" aria-hidden="true">+</span></div>
                    <form action="{{ route('tasks.store') }}" method="POST">@csrf
                        <label for="task_title">Task title</label><input type="text" id="task_title" name="task_title" maxlength="255" value="{{ old('task_title') }}" placeholder="e.g. Plan the project kickoff" required autofocus>@error('task_title')<p class="field-error">{{ $message }}</p>@enderror
                        <label for="description">Description <span style="color:#a4adbb;font-weight:500">(optional)</span></label><textarea id="description" name="description" placeholder="Add a little context or a helpful detail...">{{ old('description') }}</textarea>@error('description')<p class="field-error">{{ $message }}</p>@enderror
                        <div class="form-footer"><span class="counter"><span id="title-count">0</span>/255 characters</span><button class="button" type="submit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>Add task</button></div>
                    </form>
                </div>
                <div class="panel list-panel"><div class="list-toolbar"><h2>Your tasks</h2><div class="search-wrap"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input class="search" id="task-search" type="search" placeholder="Search tasks..." aria-label="Search tasks"></div></div>
                    <div class="task-list" id="task-list">@forelse ($tasks as $task)<article class="task-card" data-search="{{ strtolower($task->task_title . ' ' . ($task->description ?? '')) }}"><div class="task-top"><h3 class="task-title">{{ $task->task_title }}</h3><span class="badge">Not completed</span></div><p class="task-description">{{ $task->description ?: 'No description provided.' }}</p><span class="task-date">Added {{ $task->created_at?->format('M j, Y') }}</span></article>@empty<div class="empty" id="empty-state"><div class="empty-icon" aria-hidden="true"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11h6M9 15h4M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/></svg></div><p>Your task list is clear.<br>Add something you want to accomplish.</p></div>@endforelse</div><div class="no-results" id="no-results">No tasks match your search.</div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
