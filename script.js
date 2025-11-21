// Sample job data
let jobs = [
    {
        id: 1,
        title: "Web Developer",
        company: "Tech Solutions Inc",
        location: "New York",
        description: "We are looking for a skilled web developer to join our team. You will be responsible for developing and maintaining web applications using modern technologies.",
        requirements: "Bachelor's degree in Computer Science, 2+ years of experience with JavaScript and React",
        application_email: "careers@techsolutions.com",
        application_link: "",
        job_image: "",
        original_link: "",
        post_date: "2024-01-15",
        expiry_date: "2024-12-31"
    },
    {
        id: 2,
        title: "Marketing Manager",
        company: "Digital Marketing Pro",
        location: "Chicago",
        description: "Seeking an experienced Marketing Manager to develop and implement marketing strategies for our growing company.",
        requirements: "MBA in Marketing, 5+ years of digital marketing experience",
        application_email: "hr@digitalmarketing.com",
        application_link: "https://example.com/apply",
        job_image: "",
        original_link: "",
        post_date: "2024-01-10",
        expiry_date: "2024-11-30"
    },
    {
        id: 3,
        title: "Graphic Designer",
        company: "Creative Studio",
        location: "Los Angeles",
        description: "Creative graphic designer needed for branding and visual design projects. Must be proficient in Adobe Creative Suite.",
        requirements: "Degree in Graphic Design, portfolio required, 3+ years experience",
        application_email: "jobs@creativestudio.com",
        application_link: "",
        job_image: "",
        original_link: "",
        post_date: "2024-01-05",
        expiry_date: "2024-10-31"
    }
];

// Load jobs when page loads
document.addEventListener('DOMContentLoaded', function() {
    displayJobs(jobs);
    setupPagination(jobs);
});

// Display jobs function
function displayJobs(jobsToShow) {
    const jobListings = document.getElementById('jobListings');
    jobListings.innerHTML = '';

    jobsToShow.forEach(job => {
        const jobCard = `
            <div class="col-lg-6">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="job-detail.html?id=${job.id}" class="job-title">
                                ${job.title}
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <i class="fas fa-building"></i> ${job.company}
                        </h6>
                        <p class="card-text text-muted mb-2">
                            <i class="fas fa-map-marker-alt"></i> ${job.location}
                        </p>
                        <p class="card-text">
                            ${job.description.substring(0, 150)}...
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Posted: ${new Date(job.post_date).toLocaleDateString()}
                            </small>
                            <a href="job-detail.html?id=${job.id}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        jobListings.innerHTML += jobCard;
    });
}

// Search functionality
function searchJobs() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    const filteredJobs = jobs.filter(job => 
        job.title.toLowerCase().includes(searchTerm) ||
        job.company.toLowerCase().includes(searchTerm) ||
        job.location.toLowerCase().includes(searchTerm)
    );
    
    displayJobs(filteredJobs);
    setupPagination(filteredJobs);
}

// Pagination
function setupPagination(jobsToPaginate) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
    
    // Simple pagination - show all jobs on one page for demo
    // In real scenario, you can implement proper pagination
}

// Save jobs to localStorage
function saveJobs() {
    localStorage.setItem('jobs', JSON.stringify(jobs));
}

// Load jobs from localStorage
function loadJobs() {
    const savedJobs = localStorage.getItem('jobs');
    if (savedJobs) {
        jobs = JSON.parse(savedJobs);
    }
}

// Load jobs when script starts
loadJobs();
