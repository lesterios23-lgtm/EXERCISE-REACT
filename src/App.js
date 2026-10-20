import './App.css';
import Button from './component/Button';
import Card from './component/Card';
import Counter from './component/Counter';
import Form from './component/Form';
import List from './component/List';


function App() {
  return (
    <div className="App">
      <Card name="Lester" description="Ako Lang to." />
      <Card name="Lance" description="Ako ang ngani toh!" />

      <Counter />
      <Form />
      <List />
      <Button />
    </div>
  );
}

export default App;
