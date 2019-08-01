var nama_tabel='intruksi';
const objtb = idb.open('intruksiDB', 1, db => {

    if (!db.objectStoreNames.contains(nama_tabel))
    {
      db.createObjectStore(nama_tabel);
    }
    });
 
const idb_intruksi = {
    get(key) {
      return objtb.then(db => {
        return db.transaction(nama_tabel)
          .objectStore(nama_tabel).get(key);
      });
    },
    getAll() {
        return objtb.then(db => {
          return db.transaction(nama_tabel)
            .objectStore(nama_tabel).getAll();
        });
    },
    set(key, val) {
      return objtb.then(db => {
        const tx = db.transaction(nama_tabel, 'readwrite');
        tx.objectStore(nama_tabel).put(val, key);
        return tx.complete;
      });
    },
    delete(key) {
      return objtb.then(db => {
        const tx = db.transaction(nama_tabel, 'readwrite');
        tx.objectStore(nama_tabel).delete(key);
        return tx.complete;
      });
    },
    clear() {
      return objtb.then(db => {
        const tx = db.transaction(nama_tabel, 'readwrite');
        tx.objectStore(nama_tabel).clear();
        return tx.complete;
      });
    },
    keys() {
      return objtb.then(db => {
        const tx = db.transaction(nama_tabel);
        const keys = [];
        const store = tx.objectStore(nama_tabel);
  
        // This would be store.getAllKeys(), but it isn't supported by Edge or Safari.
        // openKeyCursor isn't supported by Safari, so we fall back
        (store.iterateKeyCursor || store.iterateCursor).call(store, cursor => {
          if (!cursor) return;
          keys.push(cursor.key);
          cursor.continue();
        });
  
        return tx.complete.then(() => keys);
      });
    }
  };


function sendData(intruksi)
{
    console.log('processing waktu ' + intruksi.waktu);
    // window.location = 'intruksi-dokter.php';
       // fetch('intruksi-input.php',{
    //     method: 'POST',
    //     headers:{
    //         'Content-Type':'application/json',
    //         'Accept':'application/json'
    //     },
    //     body: JSON.stringify({
    //         waktu:intruksi.waktu,
    //         id_intruksi:intruksi.id_intruksi,
    //         intruksi_dokter:intruksi.intruksi_dokter,
    //         // id_catatan:intruksi.id_catatan
    //     })
    // })
    // .then(function(response){
    //   console.log('deleting intruksi indexed' + intruksi.waktu);
    //   idb_intruksi.delete(intruksi.waktu);
        // response.text().then(function(textku){
        //     if (textku=="oke")
        //     {
        //         console.log('deleting intruksi' + intruksi.waktu);
        //         idb_intruksi.delete(intruksi.waktu);
        //     }
        // });
    // })
    // .catch(function(err)
    // {
    //     console.log("error " + err);
    // });
}