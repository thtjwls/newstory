/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017-04-16
 * Time: 오후 11:41
 */

CREATE TABLE nb_members(
  idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '인덱스',
  name VARCHAR(10) NOT NULL COMMENT '이름',
  nick VARCHAR(30) NOT NULL COMMENT '닉네임',
  id VARCHAR(15) NOT NULL UNIQUE KEY COMMENT '아이디',
  password TEXT NOT NULL COMMENT '패스워드',
  email VARCHAR(20) NOT NULL COMMENT '이메일',
  in_use TINYINT(1) NOT NULL DEFAULT '1' COMMENT '사용여부',
  regist_day DATETIME NOT NULL COMMENT '가입일',
  regist_ip VARCHAR(25) NOT NULL COMMENT '가입 ip'
) ENGINE = InnoDB DEFAULT CHAR SET = UTF8 COMMENT = '회원';

/**
 * view : 글번호,댓글, 카테고리, 글제목, 작성자, 뷰,
 * option : 삭제여부, 비밀글여부
 */
CREATE TABLE nb_category(
  idx INT(6) NOT NULL PRIMARY KEY COMMENT '카테고리 id',
  name VARCHAR(20) NULL UNIQUE KEY COMMENT '카테고리 이름',
  sub_cnt INT NOT NULL COMMENT '서브카테고리 갯수',
  path VARCHAR(30) NOT NULL DEFAULT '/' COMMENT '카테고리 경로'
) ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '카테고리 테이블';

INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('100000','HOME',0,'/');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('200000','취미·유머',0,'/main/hobby');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('300000','문화',0,'/main/culture');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('400000','강의',0,'/main/lecture');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('500000','IT',0,'/main/it');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('600000','Design',0,'/main/design');
INSERT INTO nb_category (idx, name, sub_cnt, path)
VALUES ('700000','여행·맛집',0,'/main/travel');

CREATE TABLE nb_list (
  idx INT not null PRIMARY KEY AUTO_INCREMENT comment '글번호 (code)',
  FK_category INT(6) NOT NULL comment '글 카테고리',
  subject VARCHAR(50) NOT NULL comment '글 제목',
  contents VARCHAR(255) NOT NULL comment '글 내용',
  writer INT NOT NULL comment '작성자 (code, foreign key)',
  views INT NOT NULL DEFAULT '0' comment '페이지 뷰',
  regist DATETIME NOT NULL comment '작성일',
  in_use TINYINT NOT NULL DEFAULT '1' comment '사용여부 (0 삭제, 1 사용)',
  in_secret TINYINT NOT NULL DEFAULT '0' comment '비밀글 여부 (0 미사용, 1 사용)',
  FOREIGN KEY (`writer`) REFERENCES `nb_members` (`idx`),
  FOREIGN KEY (`FK_category`) REFERENCES `nb_category` (`idx`)
) ENGINE = InnoDB DEFAULT CHARSET = UTF8;

CREATE TABLE nb_likes (
  idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT comment '인덱스',
  pid INT NOT NULL comment '원글 번호',
  FK_member INT NOT NULL comment '좋아요 누른 사람',
  likes_regist DATETIME NOT NULL comment '좋아요 누른 시간',  
  FOREIGN KEY (`FK_member`) REFERENCES `nb_members` (`idx`),
  FOREIGN KEY (`pid`) REFERENCES `nb_list` (`idx`)
) ENGINE = InnoDB DEFAULT CHARSET = UTF8;

CREATE TABLE nb_comment(
  idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT comment '댓글번호 (code)',
  pid INT NOT NULL comment '원글번호 (code, foreign key)',
  contents TEXT NOT NULL comment '댓글 내용',
  regist DATETIME NOT NULL comment '댓글 작성일',
  writer INT NOT NULL comment '댓글 작성자 (code,foreign key)',
  FOREIGN KEY (`writer`) REFERENCES `nb_members` (`idx`),
  FOREIGN KEY (`pid`) REFERENCES `nb_list` (`idx`)
) ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '블로그 뷰';

CREATE TABLE nb_comment_re(
  idx int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '인덱스',
  pid INT NOT NULL COMMENT '원댓글 번호',
  contents TEXT NOT NULL COMMENT '답글 컨텐츠',
  regist DATETIME NOT NULL COMMENT '작성일',
  writer INT NOT NULL COMMENT '답글 작성자',
  FOREIGN KEY (`writer`) REFERENCES `nb_members` (`idx`),
  FOREIGN KEY (`pid`) REFERENCES `nb_comment` (`idx`)
) ENGINE = InnoDB DEFAULT CHAR SET = UTF8 COMMENT ='댓글 > 답글';

CREATE TABLE nb_files (
  pid INT NOT NULL comment '글번호 (code, foreign key)',
  file_name VARCHAR(50) NOT NULL,
  file_type VARCHAR(10) NOT NULL,
  file_regist DATETIME NOT NULL,
  FOREIGN KEY (`pid`) REFERENCES `nb_list` (`idx`)
)ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '블로그 파일';


/**
insert test data
 */
 /*
ALTER TABLE nb_list AUTO_INCREMENT=1;
ALTER TABLE nb_comment AUTO_INCREMENT=1;
ALTER TABLE nb_comment_re AUTO_INCREMENT=1;
*/


/**
select
 */
SELECT
  nb_list.*,
  nb_members.id,nb_members.nick,nb_members.name,
  nb_category.name
FROM nb_list
LEFT JOIN nb_members
  ON nb_list.writer = nb_members.idx
LEFT JOIN nb_category
  ON nb_list.FK_category = nb_category.idx
LEFT JOIN nb_comment
  ON nb_list.idx = nb_comment.pid
  ;

