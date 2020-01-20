import React, { Component } from 'react';
import axios from 'axios';
import Nav from './components/Nav';
import List from './components/List';
import Note from './components/Note';
import urlFor from './helpers/urlFor';
import Flash from './components/Flash';
import './App.css';

class App extends Component {
  constructor() {
    super();
    this.state = {
      showNote: false,
      notes: [],
      note: {},
      error: ''
    };
  }

  toggleNote = () => {
    this.setState({
      showNote: ! this.state.showNote,
      note: {}
    })
  }

  getNotes = () => {
    axios.get(urlFor('notes'))
    .then((res) => this.setState({notes: res.data}))
    .catch((err) => console.log(err.response.data) );
  }

  getNote = (id) => {
    axios.get(urlFor(`notes/${id}`))
    .then((res) => this.setState({note: res.data, showNote: true}))
    .catch((err) => console.log(err.response.data) );
  }

  performSubmissionRequest = (data, id) => {
    if (id) {
      return axios.put(urlFor(`notes/update/${id}`), data);
    } else {
      return axios.post(urlFor('notes/add'), data);
    }
  }

  submitNote = (data, id) => {
    this.performSubmissionRequest(data, id)
    .then((res) => {
      console.log('RESPONSE', res)
      this.setState({ showNote: false})})
    .catch((err) => {
      console.log('ERROR', err);
      const { errors } = err.response.data;
      if (errors.text) {
        this.setState({ error: "Missing Note Content!" });
      } else if (errors.title) {
        this.setState({ error: "Missing Note Title!" });
      }
    });
  }

  deleteNote = (id) => {
    const newNotesState = this.state.notes.filter((note) => note.note_id !== id);
    axios.delete(urlFor(`notes/delete/${id}`) )
    .then((res) => this.setState({ notes: newNotesState }))
    .catch((err) => console.log(err.response.data) );
  }

  resetError = () => {
    this.setState({ error: '' });
  }

  render() {
    const { showNote, notes, note, error } = this.state;

    return (
      <div className="App">
        <Nav toggleNote={this.toggleNote} showNote={showNote} />
        {error && <Flash error={error} resetError={this.resetError} />}
        <br />
        { showNote ?
            <Note
              note={note}
              submitNote={this.submitNote}
            />
            :
            <List
              getNotes={this.getNotes}
              notes={notes}
              getNote={this.getNote}
              deleteNote={this.deleteNote}
            /> }
      </div>
    );
  }
}

export default App;
