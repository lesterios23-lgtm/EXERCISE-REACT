import { render, screen } from '@testing-library/react';
import App from './App';

test('renders the app button', () => {
  render(<App />);
  expect(screen.getByRole('button', { name: /click me/i })).toBeInTheDocument();
});
