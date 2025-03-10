<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Project</h1>

        <!-- Edit Project Form -->
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Project</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-2">Cancel</a>
        </form>
    </div>
</body>
</html>