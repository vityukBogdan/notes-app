import React, { Component } from 'react';

class Note extends Component {
  onSubmit(e) {
    e.preventDefault();
    const formData = {
      title: this.title.value,
      text: this.text.value
    };
    this.props.submitNote(formData, this.props.note.note_id);
  }

  render() {
    const { note } = this.props;
    return(
      <div className="note-container">
        <h2>Edit This Note</h2>
        <form
          className="note-form"
          onSubmit={(e) => this.onSubmit(e)}
        >
          <div className="note-title">
            <input
              className="note-title-input"
              type="text"
              placeholder="Note Title..."
              defaultValue={note.title}
              ref={(input) => this.title = input}
            />
          </div>
          <div className="note-textarea-container">
            <textarea
              className="note-textarea"
              placeholder="Type Here..."
              defaultValue={note.text}
              ref={(input) => this.text = input}
            />
          </div>
          <input className="note-button" type="submit" value="Submit" />
        </form>
      </div>
    );
  }
}

export default Note;