import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route } from 'react-router-dom';

// <AppContainer/> is a component that handles module reloading, as well as error handling.
// The root component of your app should be nested in AppContainer as a child.
// When in production, AppContainer is automatically disabled, and simply returns its children.
import { AppContainer } from 'react-hot-loader'; // eslint-disable-line import/no-extraneous-dependencies

import App from './components/App';

const render = (Component) => {
  ReactDOM.render(
    <AppContainer>
      <Router>
        <Route path="/" component={Component} />
      </Router>
    </AppContainer>,
    document.getElementById('root')
  );
};

render(App);

// Hot Module Replacement API
if (module.hot) {
  module.hot.accept('./components/App', () => {
    render(App);
  });
}
