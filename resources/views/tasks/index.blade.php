<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --danger-color: #ef476f;
            --warning-color: #ffd166;
            --success-color: #06d6a0;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: var(--background-color);
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .card {
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.25rem;
        }
        
        .task-item {
            border-left: 4px solid var(--primary-color);
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            background-color: white;
        }
        
        .task-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .task-item .task-name {
            font-weight: 500;
        }
        
        .task-item .priority-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            background-color: #e9ecef;
        }
        
        .task-actions .btn {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            margin-left: 0.25rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: #212529;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .sortable-ghost {
            opacity: 0.5;
            background-color: #f0f0f0;
        }
        
        .drag-handle {
            cursor: grab;
            color: #adb5bd;
            padding-right: 0.5rem;
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
        
        .navigation-buttons {
            display: flex;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header d-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0">Tasks for <span class="text-primary">{{ $selectedProject ? $selectedProject->name : 'All Projects' }}</span></h1>
            <div class="navigation-buttons">
       
                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-list me-2"></i>All Projects
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <!-- Tasks Card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Task List</h5>
                        <form action="{{ route('tasks.index') }}" method="GET" class="d-flex align-items-center">
                            <label for="project_id" class="me-2">Filter:</label>
                            <select name="project_id" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                                <option value="">All Projects</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $selectedProject && $selectedProject->id == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        @if(count($tasks) > 0)
                            <ul id="task-list" class="list-unstyled">
                                @foreach($tasks as $task)
                                    <li data-id="{{ $task->id }}" class="task-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                                            <div>
                                                <span class="task-name">{{ $task->name }}</span>
                                                <span class="priority-badge ms-2">Priority: {{ $task->priority }}</span>
                                            </div>
                                        </div>
                                        <div class="task-actions">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-tasks fa-3x mb-3"></i>
                                <p>No tasks found. Add a new task to get started.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Add Task Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add New Task</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Task Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter task name" required>
                            </div>
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project</label>
                                <select name="project_id" class="form-select">
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ $selectedProject && $selectedProject->id == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Task
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Quick Info Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Task Management Tips</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-arrows-alt text-primary me-3"></i>
                                <span>View tasks based on projects from the left side </span>
                            </li>
				<li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-arrows-alt text-primary me-3"></i>
                                <span>Drag and drop tasks to re-order, which also changes the priority </span>
                            </li>
                            
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-edit text-warning me-3"></i>
                                <span>Add tasks to existing projects from the right side card</span>
                            </li>
			<li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-edit text-warning me-3"></i>
                                <span>View project by clicking the button on the top right labeled all projects</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Drag and Drop Reordering -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const taskList = document.getElementById('task-list');
            if (taskList) {
                Sortable.create(taskList, {
                    handle: '.drag-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function (evt) {
                        const taskOrder = Array.from(taskList.children).map((task, index) => ({
                            id: task.dataset.id,
                            position: index + 1
                        }));
                        
                        fetch("{{ route('tasks.reorder') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ order: taskOrder })
                        })
                        .then(response => {
                            if (response.ok) {
                                // Optional: Show a success message
                            }
                        })
                        .catch(error => {
                            console.error('Error updating task order:', error);
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>