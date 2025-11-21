// Sample job data
let jobs = [
    {
        id: 1,
        title: "Senior Web Developer",
        company: "Tech Solutions Inc",
        location: "New York, NY",
        description: "We are looking for a skilled web developer to join our team. You will be responsible for developing and maintaining web applications using modern technologies like React, Node.js, and MongoDB.",
        requirements: "Bachelor's degree in Computer Science, 3+ years of experience with JavaScript and React, Experience with Node.js and MongoDB",
        application_email: "careers@techsolutions.com",
        application_link: "",
        job_image: "",
        original_link: "",
        post_date: "2024-01-15",
        expiry_date: "2024-12-31",
        salary: "$80,000 - $120,000"
    },
    {
        id: 2,
        title: "Marketing Manager",
        company: "Digital Marketing Pro",
        location: "Chicago, IL",
        description: "Seeking an experienced Marketing Manager to develop and implement marketing strategies for our growing company. You will lead a team of 5 marketing specialists.",
        requirements: "MBA in Marketing, 5+ years of digital marketing experience, Team management experience, Google Analytics certification",
        application_email: "hr@digitalmarketing.com",
        application_link: "https://example.com/apply",
        job_image: "",
        original_link: "",
        post_date: "2024-01-10",
        expiry_date: "2024-11-30",
        salary: "$70,000 - $100,000"
    },
    {
        id: 3,
        title: "Graphic Designer",
        company: "Creative Studio",
        location: "Los Angeles, CA",
        description: "Creative graphic designer needed for branding and visual design projects. Must be proficient in Adobe Creative Suite and have a strong portfolio.",
        requirements: "Degree in Graphic Design, portfolio required, 3+ years experience, Proficiency in Adobe Creative Suite",
        application_email: "jobs@creativestudio.com",
        application_link: "",
        job_image: "",
        original_link: "",
        post_date: "2024-01-05",
        expiry_date: "2024-10-31",
        salary: "$50,000 - $75,000"
    }
];

// Load jobs when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Simulate loading delay
    setTimeout(() => {
        displayJobs(jobs);
        document.getElementById('loading').style.display = 'none';
    }, 2000);
});

// Display jobs function
function displayJobs(jobsToShow) {
    const jobListings = document.getElementById('jobListings');
    jobListings.innerHTML = '';

    if (jobsToShow.length === 0) {
        jobListings.innerHTML = `
            <div class="col-12 text-center">
                <div class="job-card">
                    <h3>No jobs found</h3>
                    <p>Try adjusting your search criteria</p>
                </div>
            </div>
        `;
        return;
    }

    jobsToShow.forEach((job, index) => {
        const jobCard = `
            <div class="col-lg-6">
                <div class="job-card" style="animation-delay: ${index * 0.1}s">
                    <h3 class="job-title">
                        <a href="job-detail.html?id=${job.id}">${job.title}</a>
                    </h3>
                    <p class="company-name">
                        <i class="fas fa-building"></i> ${job.company}
                    </p>
                    <p class="job-location">
                        <i class="fas fa-map-marker-alt"></i> ${job.location}
                    </p>
                    <p class="job-description">
                        ${job.description.substring(0, 120)}...
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>
                            <i class="far fa-clock"></i> ${new Date(job.post_date).toLocaleDateString()}
                        </small>
                        <a href="job-detail.html?id=${job.id}" class="view-details-btn">
                            View Details <i class="fas fa-arrow-right"></i>
                        </a>
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
        job.location.toLowerCase().includes(searchTerm) ||
        job.description.toLowerCase().includes(searchTerm)
    );
    
    displayJobs(filteredJobs);
}

// Enter key support for search
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchJobs();
    }
});

// Save jobs to localStorage
function saveJobs() {
    localStorage.setItem('jobs', JSON.stringify(jobs));
}

// Load jobs from localStorage
function loadJobs() {
    const savedJobs = localStorage.getItem('jobs');
    if (savedJobs) {
        const parsedJobs = JSON.parse(savedJobs);
        jobs = [...jobs, ...parsedJobs]; // Merge with sample jobs
    }
}

// Load jobs when script starts
loadJobs();
