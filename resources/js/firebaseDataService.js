import firebase from "./firebase";
import {ref,orderByChild,query,equalTo,get} from 'firebase/database';

const db = ref(firebase,"Incidents");

class firebaseDB {
  getAll() {
    return db;
  }


  create(tutorial) {
    return db.push(tutorial);
  }

  update(key, value) {
    return db.child(key).update(value);
  }

  delete(key) {
    return db.child(key).remove();
  }

  deleteAll() {
    return db.remove();
  }
}

export default new firebaseDB;