<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #06d6a0;
            --warning-color: #ffd166;
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
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.25rem;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .project-item {
            border-left: 4px solid var(--primary-color);
            margin-bottom: 0.75rem;
            padding: 1rem;
            transition: all 0.2s ease;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .project-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .project-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        
        .project-meta {
            display: flex;
            align-items: center;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .project-meta i {
            margin-right: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.6rem 1.25rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
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
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stats-card {
            text-align: center;
            padding: 1rem;
        }
        
        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stats-label {
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 500;
            color: #6c757d;
            letter-spacing: 1px;
        }
        
        .form-control {
            padding: 0.75rem;
            border-radius: 6px;
        }
        
        .action-buttons .btn {
            margin-left: 0.3rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div>
                <h1 class="h2 mb-1">Projects Dashboard</h1>
                <p class="text-muted">Manage your projects and tasks in one place</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-tasks me-2"></i>View All Tasks
            </a>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <!-- Stats Card: Total Projects -->
                <div class="card stats-card">
                    <div class="stats-value">{{ count($projects) }}</div>
                    <div class="stats-label">Total Projects</div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Stats Card: Active Projects - assuming all are active for now -->
                <div class="card stats-card">
                    <div class="stats-value">{{ count($projects) }}</div>
                    <div class="stats-label">Active Projects</div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Stats Card: Completed Projects - placeholder for now -->
                <div class="card stats-card">
                    <div class="stats-value">0</div>
                    <div class="stats-label">Completed Projects</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <!-- Create Project Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-plus-circle text-primary me-3 fa-lg"></i>
                            <h5 class="card-title mb-0">Create New Project</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-project-diagram"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Enter project name" required>
                                </div>
                                <small class="text-muted mt-1 d-block">Give your project a clear, descriptive name</small>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Project
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Tips Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-lightbulb text-warning me-3 fa-lg"></i>
                            <h5 class="card-title mb-0">Project Tips</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 ps-0">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Create projects on the left side card
                            </li>
                            <li class="list-group-item border-0 ps-0">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                You can edit and delete previously created projects from the right side card
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <!-- Projects List Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-list text-primary me-3 fa-lg"></i>
                                <h5 class="card-title mb-0">All Projects</h5>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ count($projects) }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($projects) > 0)
                            <div class="project-list">
                                @foreach($projects as $project)
                                    <div class="project-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="project-name">{{ $project->name }}</div>
                                                <div class="project-meta">
                                                    <i class="far fa-calendar-alt"></i> Created: {{ $project->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                            <div class="action-buttons">
                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project and all its tasks?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('tasks.index', ['project_id' => $project->id]) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-tasks me-1"></i> Tasks
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-project-diagram fa-3x mb-3 text-muted"></i>
                                <h5>No Projects Yet</h5>
                                <p>Create your first project to get started</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>