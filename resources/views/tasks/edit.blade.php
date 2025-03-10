<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --success-color: #06d6a0;
            --danger-color: #ef476f;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: var(--background-color);
            padding: 2rem 0;
            color: #444;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            border: none;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.5rem;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #555;
        }
        
        .form-control, .form-select {
            padding: 0.75rem;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(76, 201, 240, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        
        .page-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }
        
        .form-section {
            margin-bottom: 1.5rem;
        }
        
        .action-buttons {
            padding-top: 1rem;
            border-top: 1px solid #eee;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Edit Task</h1>
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                    </a>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-edit text-primary me-3 fa-lg"></i>
                            <h5 class="card-title mb-0">Update Task Details</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-section">
                                <label for="name" class="form-label">Task Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                    <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
                                </div>
                                <small class="text-muted">Enter a clear, descriptive name for this task</small>
                            </div>
                            
                            <div class="form-section">
                                <label for="project_id" class="form-label">Project</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-project-diagram"></i></span>
                                    <select name="project_id" class="form-select">
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-muted">Select which project this task belongs to</small>
                            </div>
                            
                            <div class="action-buttons d-flex justify-content-between">
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Task
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle text-accent me-3"></i>
                            <small class="text-muted">Last updated: {{ $task->updated_at->format('M d, Y h:i A') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>