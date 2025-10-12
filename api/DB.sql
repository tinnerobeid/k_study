CREATE TABLE IF NOT EXISTS students (

   id INT AUTO\_INCREMENT PRIMARY KEY,

   name VARCHAR(100),

   email VARCHAR(100) UNIQUE,

   password VARCHAR(255),

   date\_of\_birth DATE,

   nationality VARCHAR(50),

   education\_background TEXT,

   created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS universities (

   id INT AUTO\_INCREMENT PRIMARY KEY,

   name VARCHAR(255),

   email VARCHAR(100) UNIQUE,

   password VARCHAR(255),

   country VARCHAR(100),

   description TEXT,

   website VARCHAR(255),

   created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP

);

CREATE TABLE IF NOT EXISTS courses (

   id INT AUTO\_INCREMENT PRIMARY KEY,

   university\_id INT,

   name VARCHAR(255),

   description TEXT,

   duration VARCHAR(100),

   fees DECIMAL(10,2),

   level ENUM('Bachelors', 'Masters', 'PhD'),

   created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP,

   FOREIGN KEY (university\_id) REFERENCES universities(id) ON DELETE CASCADE

);

CREATE TABLE IF NOT EXISTS scholarships (

   id INT AUTO\_INCREMENT PRIMARY KEY,

   university\_id INT,

   title VARCHAR(255),

   description TEXT,

   eligibility TEXT,

   amount DECIMAL(10,2),

   deadline DATE,

   FOREIGN KEY (university\_id) REFERENCES universities(id) ON DELETE CASCADE

);

CREATE TABLE IF NOT EXISTS documents (

   id INT AUTO\_INCREMENT PRIMARY KEY,

   student\_id INT,

   file\_name VARCHAR(255),

   file\_path VARCHAR(255),

   uploaded\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP,

   FOREIGN KEY (student\_id) REFERENCES students(id) ON DELETE CASCADE

);
