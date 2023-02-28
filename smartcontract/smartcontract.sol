pragma solidity ^0.6.0;

contract SupplyChain {
    event Added(uint256 index);

    struct State {
        uint256 productId;
        string shortDescription;
        string detailDescription;
        address person;
        string barCode;
    }

    mapping(uint256 => State) public allState;
    uint256 public detail = 0;

    struct Product {
        address creator;
        string userName;
        string productName;
        uint256 productId;
        string date;
        string price;
        string img;
        string qrcode;
        uint256 totalStates;
        mapping(uint256 => State) positions;
    }

    mapping(uint256 => Product) public allProducts;
    uint256 public items = 0;

    struct Rate {
        address user;
        string comment;
        string star;
        string dateComment;
        string username;
        string productId;
        uint256 idRate;
    }

    mapping(uint256 => Rate) public allComments;
    uint256 public comments = 0;

    function concat(string memory _a, string memory _b)
        public
        returns (string memory)
    {
        bytes memory bytes_a = bytes(_a);
        bytes memory bytes_b = bytes(_b);
        string memory length_ab = new string(bytes_a.length + bytes_b.length);
        bytes memory bytes_c = bytes(length_ab);
        uint256 k = 0;
        for (uint256 i = 0; i < bytes_a.length; i++) bytes_c[k++] = bytes_a[i];
        for (uint256 i = 0; i < bytes_b.length; i++) bytes_c[k++] = bytes_b[i];
        return string(bytes_c);
    }

    function newItem(
        string memory _userName,
        string memory _text,
        string memory _date,
        string memory _price,
        string memory _img,
        string memory _qrcode,
        uint256 _productId
    ) public returns (bool) {
        Product memory newItem = Product({
            creator: msg.sender,
            userName: _userName,
            totalStates: 0,
            productName: _text,
            productId: _productId,
            date: _date,
            price: _price,
            img: _img,
            qrcode: _qrcode
        });
        allProducts[items] = newItem;
        allProducts[_productId] = newItem;
        items = items + 1;
        emit Added(items - 1);
        return true;
    }

    function newComment(
        string memory _comment,
        string memory _star,
        string memory _dateComment,
        string memory _username,
        string memory _productId
    ) public returns (bool) {
        Rate memory newComment = Rate({
            user: msg.sender,
            comment: _comment,
            star: _star,
            dateComment: _dateComment,
            username: _username,
            productId: _productId,
            idRate: comments
        });
        allComments[comments] = newComment;
        comments = comments + 1;
        emit Added(comments - 1);
        return true;
    }

    function addState(
        uint256 _productId,
        string memory _shortDescription,
        string memory _detailDescription,
        string memory _barCode
    ) public returns (bool) {
        require(_productId != detail);
        State memory newState = State({
            person: msg.sender,
            shortDescription: _shortDescription,
            detailDescription: _detailDescription,
            barCode: _barCode,
            productId: _productId
        });

        allState[detail] = newState;
        allState[_productId] = newState;
        detail = detail + 1;
        return true;
    }

    function searchProduct(uint256 _productId) public returns (string memory) {
        require(_productId != items);
        string memory output = "";
        string memory output2 = "";
        output = concat(
            output,
            "<div class='row justify-content-center mb-3 p-3'>"
        );
        output = concat(output, "<div class='col-md-12 col-xl-10'>");
        output = concat(
            output,
            "<div class='icon-box card shadow-0 border rounded-3'>"
        );
        output = concat(output, "<div class='card-body'>");
        output = concat(output, "<div class='row'>");
        output = concat(
            output,
            "<div class='col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0'>"
        );
        output = concat(
            output,
            "<div class='bg-image hover-zoom ripple rounded ripple-surface'>"
        );
        output = concat(output, "<img src='img/Product/");
        output = concat(output, allProducts[_productId].img);
        output = concat(output, "'class='w-100 d-block me-auto' />");
        output = concat(output, "<div class='hover-overlay'>");
        output = concat(
            output,
            "<div class='mask' style='background-color: rgba(253, 253, 253, 0.15);'></div>"
        );
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "<div class='col-md-6 col-lg-6 col-xl-6'>");
        output = concat(output, "<h5>");
        output = concat(output, allProducts[_productId].productName);
        output = concat(output, "</h5>");
        output = concat(output, "<div class='mt-1 mb-0 text-muted small'>");
        output = concat(output, "<span>Người đăng tải : ");
        output = concat(output, allProducts[_productId].userName);
        output = concat(output, "</span>");
        output = concat(output, "</div>");
        output = concat(output, "<div class='mt-1 mb-0 text-muted small'>");
        output = concat(output, "<span>Ngày đăng tải : ");
        output = concat(output, allProducts[_productId].date);
        output = concat(output, "</span>");
        output = concat(output, "</div>");
        output = concat(output, "<div class='mt-1 mb-0 text-muted small'>");
        output = concat(output, "<span>Mô tả : ");
        output = concat(output, allState[_productId].shortDescription);
        output = concat(output, "</span>");
        output = concat(output, "</div>");
        output = concat(
            output,
            "<div class='row align-items-end'><div class='col-12 col-md-6'><div style ='display: grid;'class='mt-1 mb-0 text-muted small'>"
        );
        output = concat(output, "<span>QR Code : ");
        output = concat(output, "</span>");
        output = concat(output, "<div class='d-flex justify-content-center'>");
        output = concat(
            output,
            "<img style='z-index:99;'  src='img/QRProduct/"
        );
        output = concat(output, allProducts[_productId].qrcode);
        output = concat(output, "'class='w-25 qrcustom2 d-block'/>");
        output = concat(output, "</div>");
        output = concat(
            output,
            "<a class='btn btn-primary qrDownload' id='qrDownload' href='img/QRProduct/"
        );
        output = concat(output, allProducts[_productId].qrcode);
        output = concat(output, "' download> Tải mã QR </a>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(
            output,
            "<div class='col-12 col-md-6'><div style ='display: grid;'class='mt-1 mb-0 text-muted small'>"
        );
        output = concat(output, "<span>Mã vạch : ");
        output = concat(output, "</span>");
        output = concat(output, "<div class='d-flex justify-content-center'>");
        output = concat(output, "<img style='z-index:99;'  src='img/barCode/");
        output = concat(output, allState[_productId].barCode);
        output = concat(output, "'class='w-25 qrcustom2 d-block'/>");
        output = concat(output, "</div>");
        output = concat(
            output,
            "<a class='btn btn-primary qrDownload' id='barCodeDownload' href='img/barCode/"
        );
        output = concat(output, allState[_productId].barCode);
        output = concat(output, "' download> Tải mã vạch </a>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(
            output,
            "<div class='col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start'>"
        );
        output = concat(output, "<div class='align-items-center mb-1'>");
        output = concat(output, "<h4 class='mb-1 me-1 text-wrap'>");
        output = concat(output, allProducts[_productId].price);
        output = concat(output, ".VND</h4>");
        output = concat(output, "</div>");
        output = concat(output, "<div class='d-flex flex-column mt-4'>");
        output = concat(output, "<a href='product-detail/");
        output = concat(output, allProducts[_productId].qrcode);
        output = concat(
            output,
            "' class='btn btn-primary' type='button'>Liên hệ</a>"
        );
        output = concat(output, "<a href='product-detail/");
        output = concat(output, allProducts[_productId].qrcode);
        output = concat(
            output,
            "' class='btn btn-outline-primary mt-2 p-0' type='button'>Xem chi tiết"
        );
        output = concat(output, "</a>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");
        output = concat(output, "</div>");

        if (allProducts[_productId].productId != _productId) {
            output2 = concat(
                output2,
                "<h5 class='text-center card p-5 card-title text-danger m-0 p-0 font-weight-bold'>Hiện tại chưa có sản phẩm nào</h5>"
            );
            return output2;
        } else if (allProducts[_productId].productId == _productId) {
            return output;
        }
    }
}
