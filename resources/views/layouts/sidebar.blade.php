<style>
    .sidebar {
        position: fixed;
        height: 100vh;
        width: 250px;
        top: 0;
        left: 0;
        background: linear-gradient(145deg, #1e293b, #0f172a);
        color: #f1f5f9;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        padding: 0;
    }

    .sidebar h1 {
        font-size: 1.75rem;
        margin: 20px;
        color: #e2e8f0;
        text-align: center;
        font-weight: bold;
        border-bottom: 1px solid #334155;
        padding-bottom: 10px;
    }

    .sidebar a {
        text-decoration: none;
        color: #f1f5f9;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #334155;
        padding-left: 30px;
        border-left: 4px solid #e2e8f0;
    }

    .sidebar a svg {
        width: 20px;
        height: 20px;
        color: #94a3b8;
        transition: color 0.3s ease;
    }

    .sidebar a:hover svg {
        color: #f1f5f9;
    }
</style>

<div class="sidebar">
    <h1>{{$title}}</h1>
    <a href="/add-location">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 10.5V3.75a.75.75 0 0 0-.75-.75h-7.5a.75.75 0 0 0-.75.75V10.5m15 0h-3M3 10.5h3m-3 0v6.75a.75.75 0 0 0 .75.75h16.5a.75.75 0 0 0 .75-.75V10.5m-18 0V9m18 1.5V9m-18 0H3m18 0h-3M3 15.75V18h18v-2.25" />
        </svg>
        Add Map
    </a>
    <a href="/view-location">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 3v16.5c0 .414.336.75.75.75h7.5a.75.75 0 0 0 .75-.75V3.75a.75.75 0 0 0-.75-.75H4.5a.75.75 0 0 0-.75.75zm9 16.5H19.5c.414 0 .75-.336.75-.75V9.75a.75.75 0 0 0-.75-.75h-7.5a.75.75 0 0 0-.75.75v9.75a.75.75 0 0 0 .75.75zm0-8.25H19.5M12.75 9H9" />
        </svg>
        View Map
    </a>
</div>
