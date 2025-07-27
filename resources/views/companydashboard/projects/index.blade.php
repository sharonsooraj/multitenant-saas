@extends('companydashboard.layouts.app')

@section('content')
    <div class="container mt-4" style="margin-left: 282px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Projects</h4>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Create Project
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="projects-table" class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $index => $project)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->client->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $project->status == 'completed' ? 'success' : ($project->status == 'ongoing' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $project->start_date ?? '-' }}</td>
                                    <td>{{ $project->end_date ?? '-' }}</td>
                                    {{-- <td>
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button class="btn btn-sm btn-outline-danger delete-project-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteProjectModal"
                                            data-id="{{ $project->id }}"
                                            data-title="{{ $project->title }}">
                                            🗑 Delete
                                        </button>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No projects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Project Modal -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteProjectForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong id="projectTitleToDelete"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none'; // 👈 Add this

            $('#projects-table').DataTable({
                language: {
                    emptyTable: "No companies available yet."
                }
            });
        });
    </script>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-project-btn');
            const deleteForm = document.getElementById('deleteProjectForm');
            const projectTitleToDelete = document.getElementById('projectTitleToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const projectId = this.getAttribute('data-id');
                    const projectTitle = this.getAttribute('data-title');
                    projectTitleToDelete.textContent = projectTitle;
                    deleteForm.action = `/admin/projects/${projectId}`;
                });
            });


        });
    </script>
@endsection
