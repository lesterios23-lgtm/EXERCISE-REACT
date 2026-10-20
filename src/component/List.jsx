import {useState, useEffect} from 'react';

export default function List() {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Request failed with status ${response.status}`);
                }
                return response.json();
            })
            .then(setData)
            .catch(setError)
            .finally(() => setLoading(false));
    }, []);

    if (loading) return <p>Loading...</p>;
    if (error) return <p>Unable to load users: {error.message}</p>;

    return (
        <ul>
            {data.map(user =>
                <li key={user.id}>
                    {user.name}
                </li>
            )}
        </ul>
    )
}