// import React from "react";

// const App = () => {
//   return (
//     <div>
//       <h1>bye bye</h1>
//     </div>
//   );
// };

// export default App;
import React, { useState, useEffect } from "react";
import axios from "axios";

function App() {
  const [data, setData] = useState([]);

  // useEffect(() => {
  //   // Fetch data from Drupal REST API
  //   axios
  //     .get("http://d10d1.test/jsonapi/node/article")
  //     .then((response) => {
  //       setArticles(response.data.data);
  //     })
  //     .catch((error) => {
  //       console.error("Error fetching data:", error);
  //     });
  // }, []);

  useEffect(() => {
    axios
      // .get("http://d10d1.test/jsonapi/node/article")
      .get("http://d10d1.test/api/articles_list")
      .then((res) => {
        console.log(res.data);
        // let title = res.data.data.map((article) => {
        //   return article.relationships.field_image.links.self.href;
        // });
        // console.log(title);
        setData(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  return (
    <div className="App">
      <h1>Articles from Drupal</h1>
      <ul>
        {data.map((article, index) => {
          return (
            <div key={index}>
              <li>{article.title}</li>
            </div>
          );
        })}
      </ul>
    </div>
  );
}

export default App;
