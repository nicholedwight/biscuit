import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import logo from './logo.svg';
import './App.css';

class Header extends React.Component {
  // constructor() {
  //   super();

  //   this.state = { isAuthenticated: false, user: null, token: ''};
  // }
  render() {
    return (
      <nav>
        <a href="#" class="logo">Biscuit</a>
        <a href="#" class="user">Welcome, {this.props.name}</a>
        <a href="#" class="logout">Logout</a>
      </nav>
    );
  }
}

export class Feed extends Component {
  render() {
    return (
      <header>
        <p>This is a test</p>
      </header>
    )
  }
}


// const element = <Header {userName} />;
ReactDOM.render(
  <Header  name="Nichole"/>,
  document.getElementById('header')
);

ReactDOM.render(<Feed/>, document.getElementById('feed'));
  
  // onSuccess = (response) => {
  //   const token = response.headers.get('x-auth-token');
  //   response.json().then(user => {
  //     if (token) {
  //       this.setState({isAuthenticated: true, user: user, token: token});
  //     }
  //   });
  // };

  // onFailed = (error) => {
  //   alert(error);
  // };

  // logout = () => {
  //   this.setState({isAuthenticated: false, token: '', user: null})
  // };

  // render() {
  //   let content = !!this.state.isAuthenticated ?
  //     (
  //       <div>
  //         <p>Authenticated</p>
  //         <div>
  //           {this.state.user.email}
  //         </div>
  //         <div>
  //           <button onClick={this.logout} className="button" >
  //             Log out
  //           </button>
  //         </div>
  //       </div>
  //     ) :
  //     (
  //       <TwitterLogin loginUrl="http://localhost:4000/api/v1/auth/twitter"
  //                     onFailure={this.onFailed} onSuccess={this.onSuccess}
  //                     requestTokenUrl="http://localhost:4000/api/v1/auth/twitter/reverse"/>
  //     );

  //   return (
  //     <div className="App">
  //       {content}
  //     </div>
  //   );
  // }


export default Header;
