/* Global Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f6f9;
    color: #333;
}

header {
    background-color: #004080;
    color: white;
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

header h1 {
    margin: 0;
    font-size: 2.5rem;
}

nav ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
}

nav ul li a:hover, nav ul li a.active {
    background-color: #0066cc;
    border-radius: 5px;
}

/* Page Title */
.page-title {
    text-align: center;
    padding: 40px 20px 20px;
}

.page-title h2 {
    margin-bottom: 10px;
    font-size: 2rem;
    color: #004080;
}

.page-title p {
    color: #555;
    font-size: 1.2rem;
}

/* Academic Content */
.academic-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

.academic-item {
    background-color: white;
    border-left: 5px solid #004080;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease-in-out;
}

.academic-item:hover {
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

.academic-item h3 {
    color: #004080;
    margin-bottom: 10px;
    font-size: 1.8rem;
}

.academic-item p {
    font-size: 1rem;
    margin: 5px 0;
}

.academic-item img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 8px;
}

.posted-time {
    font-style: italic;
    color: #555;
    margin-top: 10px;
}

/* Hub Section */
.hub-of-intellectual-challenge {
    background-color: #e8f0ff;
    padding: 30px;
    margin: 40px auto;
    max-width: 1000px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.hub-of-intellectual-challenge h3 {
    color: #002b5c;
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.hub-of-intellectual-challenge h4 {
    margin-top: 20px;
    color: #004080;
}

.hub-of-intellectual-challenge ul {
    list-style-type: square;
    padding-left: 20px;
}

.hub-of-intellectual-challenge ul li {
    font-size: 1.1rem;
}

/* Footer */
.footer {
    background-color: #002b5c;
    color: white;
    text-align: center;
    padding: 20px 10px;
    margin-top: 60px;
    box-shadow: 0 -4px 6px rgba(0,0,0,0.1);
}

.footer a {
    color: #a3d0ff;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }

    nav ul {
        flex-direction: column;
        margin-top: 20px;
    }

    nav ul li {
        margin: 10px 0;
    }

    .academic-container {
        padding: 10px;
    }

    .academic-item {
        margin-bottom: 15px;
    }

    .page-title h2 {
        font-size: 1.8rem;
    }

    .footer {
        font-size: 0.9rem;
    }

    .hub-of-intellectual-challenge {
        padding: 20px;
    }

    .hub-of-intellectual-challenge h3 {
        font-size: 1.6rem;
    }

    .hub-of-intellectual-challenge h4 {
        font-size: 1.2rem;
    }

    .hub-of-intellectual-challenge ul li {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    header h1 {
        font-size: 1.6rem;
    }

    .academic-item h3 {
        font-size: 1.5rem;
    }

    .academic-item p {
        font-size: 0.9rem;
    }

    .footer {
        font-size: 0.8rem;
    }
}
