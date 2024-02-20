import * as ReactDOM from 'react-dom';
import App from './App';
import * as React from 'react';
// @ts-ignore
const reactContainerId = appLocalizer.reactContainerId;

document.addEventListener( 'DOMContentLoaded', function() {
    var element = document.getElementById( reactContainerId );
    if( typeof element !== 'undefined' && element !== null ) {
        ReactDOM.render( <App />, document.getElementById( reactContainerId ) );
    }
} )