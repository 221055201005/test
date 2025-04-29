<?php

$server_warehouse = ($this->user_cookie[12] == getenv('IP_FIREWALL_GATEWAY') ? getenv('LINK_WAREHOUSE_OUTSIDE') : getenv('LINK_WAREHOUSE'));
error_reporting(0);

?>
<style>
  .buttonxx {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 10px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
  }

  .button3xx {
    background-color: white;
    color: black;
    border: 2px solid #f44336;
  }

  .button3xx:hover {
    background-color: #f44336;
    color: white;
  }

  .button4xx {
    background-color: white;
    color: black;
    border: 2px solid #001aff;
  }

  .button4xx:hover {
    background-color: #001aff;
    color: white;
  }

  .button5xx {
    background-color: white;
    color: black;
    border: 2px solid #0f8c31;
  }

  .button5xx:hover {
    background-color: #0f8c31;
    color: white;
  }
</style>
<?php

$img_sembcorp = "iVBORw0KGgoAAAANSUhEUgAAAsIAAADOCAIAAAC7LfPcAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAOzZJREFUeJzt3Qd4FFXbN3CTQEKHSA1NIEDoTUQEJKGGgLRIR4ogSDOiIh0EpDcpgtJECaIUA1JFSiihQ4AQIAmETmihpJJ+f/dJfPPxLGH37Ozszib5/665vJ6XF+bMmd095z8zZ855iwAAAAAUeUvrAwAAAIDMCjECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQIwAAAEAhxAgAAABQCDECAAAAFEKMAAAAAIUQI4SERLp0g/7YT9PX0dCF1HkCtfiaPhhGDYdS4+Hk/i31nEYjf6Slf9Huk3TrISWnaH3EAAAAViD7xoiX8RR4g/72o1HLqeVXVK0vFWlPOZrRW65v3PK0otIfU92B1GmCCBy+5+nOI0pM0romAAAAGsl2MeJZJB30p5nrqckIKtqe7PTmBv2bfQty7kHtx9KqHeQfkhKXoHXdAAAALCsbxYiX8bRsa8r7n4ubCjZKo0OGm60bObYlj9F0Lhg3JwAAIBvJFjHi/DX67hdy6qxmdMhws3Ojep/R6p0UFYvREwAAkPVl5RiRlEw7j1O70ZTThCcXyrYCbcRQzZsPECYAACAry5oxIiWFLlyjxsPIpqmlA8SrW66WNHkN3X6UIg4IAAAgy8lqMSIxiU4EUv9ZVKyDlgEifbN1o6p9aMkWuvlA61MDAACgtqwTI/iC/9QV+nIJFW6vfXrQ2XI0o3LdaNFmeh6l9WkCAABQT9aJETuPk3NPcfWveWh402bXTAyYCAjV+kwBAACoJCvECL8A+niSyu9wmmnjg8zrTpPWUGSM1mcNAADAZJk7RryMp5+2UT73zJEh/n+YaEqVetHxQK1PHwAAgGkycYw4fZU6jKM8rbWPBcqSRJH2NPt3DL0EAIBMLFPGiBfRtGCjmMpa2/c5Td9s3ahWf7GuRwLmvgQAgEwo88WIx89p5BLK2Vz7EKDWVqYLrd2NVUMBACDzyWQx4shFcumtfcdvjq3V1/TgqdbnFwAAwBiZJkbEvKR+M8RoSs37e/NtTp3ozwOUkKj1uQYAAJCTOWLE0wgaMl8szK15T2/urUQnMeVlbJzWZxwAAECCtceIpGTa7kdNR2jfwVtsy9WSPp9PwXe0PvUAAACGWHuM2HKICn+kfddu4c3WjSr0oJthWp99AAAAvaw3RiQl0dwNVLCt9p26Vlu5bnTxOhYHBQAA62WlMSIihjy+1b4j13zL34Ym/0LxCVp/HgAAABmxxhhx4Tq1+Er7LtxKNjs3sQZHHJIEAABYH+uKESlExy5R7U8z2RoZ5t7ytKIBszGrBAAAWB0rihGJSfT7PjEgQPNu2zq3hkPo+j2tPyQAAIBXWFGM2O5HBT20762teWs7mp5Haf05AQAA/B9riRFr91DOZtr309a/le9OJy5r/WkBAACk0j5GxCXQsq0ptlp3z5loq9CDAkK1/tisWGJi4osXL+7fv3/z5s2QkJCrV68GBQWFhobeu3eP/zw5OVnrAwQAyDo0jhEv42nar5SntfZ9c+ba3htM249p+9FZi/j4eM4Hx44dW7du3YQJE7p27dqkSZO6detWrly5XLlyJUuWLFGihJOTU5kyZSpVqlSnTp0WLVr069dvwYIFe/fu5YQRGxurdQ0ANJOUlPRSTgpmsIE30DJGhL+gcSvE3M+a98qZcSvUljb5avjpaezx48cnT56cNm2aq6trxYoVc+fO/ZaRbG1tOWE0atRo5MiR27Ztu3v3LjepWlcLwKJ8fHwaygkJCdH6YMFKaRYjONl+tZTyW82YSpvXtgz/X2+5WtHLqKU8s+PSG4mJifv37+/Ro0fx4sWNjQ5vkitXrjZt2sybNy8sLEzr+gFYzs8//yz5G7lw4YLWBwtWSpsYwRlixCLtc4OdG5X+WEyXyQezcCP5HKETgRRyVywoGhv/36Emp1BULIWF0+WbtP8srfuHpq+jAXPowy/E/QAbrVNFiU702z+afIYaiImJmT17doUKFWxsbNQKEDpy5Mjh6enp7e2Nhx2QHSBGgOk0iBGPnmuZIUp3oV7TaNZ6OnRB5ANTpKTQ7Uf0tx+NXSFexczfRptUkc+dfv2HsvZzy+jo6OXLl5cuXdpM6eF177zzzpQpU3BzArI2xAgwnaVjRPRL+upH0fNZsqMt2Jaq96P+M2nNLjoTROERpO5o/bgEuveEDl+g73+jTuOpXHfKYdmXV11607q9WTZI3Lt3z8vLq2DBgmbNDa9zcHBo0qTJ1q1bo6IwWQdkTYgRYDqLxoiYOBq1nOxbWKJntXGlUh9T629S5m4Q0eHxcwvVMSmZbj2gf06JmtYZQHktFZjyt6E/9luojpa0c+fOqlWr2tramjUx6GFvb9+0adMtW7a8fPlS65MBKktOTt63b98UCdeuXdP6YM0CMQJMZ9EYMeZncrDIexlOnWnO7xRyNyVR06H3zyLFEiGD5qZY5m2Ugm3obJCW9VXdkSNHLH8TIkN58uT58ssvw8PDtT4loKbExMSxY8fKfAH++SdrDkFCjADTWS5GTF1r9n608EfUdTLtPml1K2vfekC/7KLGw8w+cqJCd9p5XOvaquT48eMqvothOhsbm3Llyvn6+mp9YkA1iBGIEWA6C8WIHzaZsQd1aCmWrVq3V0xmZeUu3aCZ3uTcw4xJomgHOuivdT1NduDAAUdHRxM6fXOxs7ObPHnyo0ePtD5DoALECMQIMJ3ZY0Rikhj9Z+emfn/JuSS/O7X9lvwz27QoMS9p5XaxHro5TgtvlXtT0O1MPOIyPDy8fv36Cvp4W1tbZ2fntm3bLliw4NSpUw8fPkybei8+Pv7mzZt79+6dMWNGixYtXFxccuXKpWD/6VxdXe/dw3KrmR5iBGIEmM68MSI5mbz3kmNbtQNEUyrThb5cQicvi1c/MqknL8TC6N2+I8d26gesmv0p8IbWNVSEW3bu7HPkyGFUv+7o6NixY8eNGzfeuXNH/6oZCQkJYWFhBw4cmDx5csOGDZXlCc4rLVu2PHLkiMVOC5gDYsS2bduayMmqg0zBdGaMEckpYu3vYh3U7CBzNqcGn4tHJNezyqVgfKIIQxyJKqj9pKNaHzEmI9PhKODk5CTfo9vb2zdv3vzw4cOcD4wtKyoqat++ff379y9ZsqSxSSJnzpx9+/Y1xxkAi0GM4MydKAdrasCbmDFGnA2i+oPUvMIu2oE+n59yLasECB1HA6jVNyqPIOk7gzLdb58zgVHdea9evYKDg00pkZtIHx+fmjVrGlVu7dq1z507p1atQROIEQCmM1eMCL0v5mlWK0C8/RHNXG/qpJOZwqUbNHAO5W6lWpLoMpmeZ57Jk06dOmVUXz5kyBC1LpJiY2N37NhRrlw5mXKLFi168uRJVcoFDSFGAJjOLDEiNo4aDVWnF3T8iEb/RA+emuMwrdeRi9RujGrzdI39mbSdP0Oel5eXZICwsbGpUaMGdwPqHsDTp0+bNm3q4OCgp2j+/86dO1fdckETiBEAplM/RnCXP3KpCjfni7SnfjPJ7xIlqNxTZA4xcbTlkHiR1fR5MAt6iIGuSarO/20OycnJFStWlIwRlStX3r/fLNN2hoeHL1u27E1TVnB8mTRp0rNnz8xRNFgYYgSA6VSOEREx1Pt7U1eUcOpMvaaK1zgz3XN91T2Poh3HyNVLjC016ZR2EuNSrdyVK1ckl+60tbVduHCh+cZ8caA5ePDge++993rRHTp0wKzYWQZiBIDpVI4R6/ZS7tYmdXgVe9KfB8RjEUh38wF9tdTU9cyKtCcrH526adMmmQadFS5c+OLFi+Y+noCAgBo1arxabt68eS1QLlgMYgSA6dSMEUv/osLtlfdzZbvQsq0UGaPiEWUp957QJ9+TnQlJoson1jvckhv0CRMmSMaIZs2aKXi9U4Hnz583btw4rdASJUqsX7/eAoWCxSBGAJhOtRjx7xnKqfRZRt7WNH5VJp5IypIu36Quk8hO6alu/bWVTrkRHh7eq1cvyRjBTb/FDiw6Orpnz5558+b9/fffLVYoWAZiBIDp1IkR4REKp4jI0ZyajiCfwxpniJfxYk7Jm2Gik/YPphOBdPQi+Z4X26EL5BdAp67Q+WsUfIfuPqbnkRq/+MDHMHaFwumqcragYQut8ZnR/fv327VrJxkjli5daslju3PnzuzZs1+8eGHJQtMkJSXdvXv3zJkz27ZtW7hw4fjx44cOHdo/Ff+PMWPGzJ8/38fH59SpU7du3bLMHZqsBDECwHQqxIjr98WMzsb2Z2kTNs/9g55GmH4IRkhIFN3wxeu06wQt2CjGHHQYRw2HUo3+9E43KtaRCniItb7SL/dt3MTwxjytqVA7KulJFXtR7QH04QhR5fGraM0usQ7W1dv0+LmYtdNikpLFgInB85S8x8G1W7jJ6l7c4F6wWbNmkjHC29tb6+M1r4iIiKNHj86cOdPDw6NixYr58uXTP/g0T5485cuXb9Wq1bfffuvr6/vkyRMrnHOQDykqKur27dsXL148ceLEkSNHDh06xNU8ffr0lStX7t27Fx9v6bX1smSM4NP49OlTzr7Xr18PDg6Ojc0G8+1YMf7a8885LCzs2rVrV69evXz5clBQUGhoKP9JTIzKj/CTk5OfP3/OFx4hISFcFv+s+Atw8+bNx48fm/VrYGqMSExM6TfTuNc7bZqKrfMEevjUYu9iiEb1eCBNWk0tRooo8PZHIh8oey7w+g2VEp2pWj/qOJ5W76KQu5RaJ0tUjKOAzxGRxvh8GnXMRdqLs2FVuNXjXlAyRqxdu1br4zUX/qYuX768adOmefPmlTwbOhwcHGrVqrVo0aK4OGu56cTN5d69e/v371+/fv0KFSq8/fbbuXLlsrOz42yUI0cOzkDFixevVKlSixYtODnduGG5xWCyUowICAhYs2ZNnz59GjVqVLNmTWdn5zJlypQrVw5zrWqFE8PChQs9PT3r1avn4uJSunRp/p4XK1bMycmpbNmy/CcNGjTo3r37qlWrwsPDTSmIv8Znz56dMWMGN6F16tThC49SpUqVKFGCiytZsuQ777xTvXp1Lot/gNu2beNrDLUqmM7UGPHbP5SrpXF9WKVetGizJa6GI2Jo3xma9is1/4qKdvzvFogq0eFN91d4s3UTMaXXNFqyRTwisUCaePycBs8VtyWMqp1TZ7p21/wHJ42zeYcOHSR7yiw5+xNfsmzatEnn3RBT1K5de968eRqGiejoaB8fn169euXPn1/+sG1tbZs0aTJnzpwM5zg/evRofwk7d+6UOUL5GMENtEy5bNSoUQbL5S5fZlfcMehZZy4pKcnf33/WrFldu3blPiPDw+a4duLECT1H4uvrK1mv27dv668Un/MBAwbo38no0aPNNOfKggULZGrh5+enfz/cy/InKLOrDO8l8D9ft25dv379OMbJf+c5SXM3v3jxYqOenHLg/uGHHziIcDSRLyt37txt2rT5+eefTcwurzIpRhy9aMTKW9zJObSgEYvoWaRaB5+BuATy9adJa6jpF+JhhFlzg0yqKNyeOk0Qy4JfCjVjrVNSxKOl5l8aV9+a/a1oWCv/frgNkvwlZLE1sRISEjZv3syX6fJtgTy+NNm/f7+Fnxc8fvyYGzi+JDLlyHPkyNG6deuffvrp1fb6119/lfm3s2fPljlO+Rghr1y5cgbL/eeff2R2xXHq9Xla+aPctWvXJ598ItN5GIwRKi4Uzufc4MK8/G28e9csly/cNcrUgr8/+vdz8+ZNyRnxnz9/nv6vuFJLlix57733lK0YnK5gwYLcDOo/RUFBQRMnTnz//fclZ9l5k7x5806YMEGVIV/KY8TdR+LeuHy/VbGneJvDHE8xeJfcHZ65KjJK2a6pd/iNvMlv9i31Oc67n9GGfXTllljV0xySU2jED1TEmCVVRy03y5EowJdWkyZNkvwB1K1bl6/dtT5kdfDlC7eAxi6MbhS+vh88eLDFhohyv6VgxVQ9ypQps23btkePHlE2jhHJycncu8yZM6do0aLyB4MYoUPdGBEXF3fp0qWBAwfa29vL/BNJlStXPnbsmM6BcXz08/Pz9PRUtyyu7PHjx008+QpjxMt4aj9W9pF8rlbUe5oYEqi6R89o/znyWiwmjS7goXVWkNjs3MSKZW1Hi0GO54LFaVQXB5RDF6jJcNk3QvO2FvNkW8mKG7/99pvkVz9//vxHjx7V+nhNxT1EQEAAX1Wo2Ci8CbfvXbt2DQ015z0x/j0+esTXZEWKFFH9+B0cHGrXrr148eLvvvtO5u9npRjB/Qd/2/v06VOpUiVOhEYdDGKEDhVjhLe3Nxf6psdJJipWrBi3h2mHFBYWtmHDhrZt2xr1cFBehqnFKApjxLRfpe5D2LqJDn77MYpX7020lBSRHv49TZ/NoWp9RUbRPBwo2DiBFWpLrl/QhFXibVJ1Hy48ek5zN1Cpj6WO5O124qUVa3DlyhX5r37v3r0z9Q0J7huWLl3K19nmaBcyZGNjw+2Fr6+vmWoUHBzcqlUrc99WkbxpnDViRN26ddeuXduhQ4d8+fIpOxjECB0qxgizftUZf+icHhYsWFCjRg07OzuzlsUZ/eDBg4pPvpIYERAq3nQw3FO6igxx4briY8sAd7d/HhCLX+dro30UUGt7pyt9sYgOX1D5ic+2o+L9VZkDaPU1vYhWs2hlEhIS5OM2X/IabBGs2YEDB4waGKWW6tWrm2OodmRkpPzsYRaQNWJE7ty58+TJY8rBIEboUDFGWAB/+uYOK2n4GsPNzU3xW+JGx4ig26LbM3gromBbWv8vRav0qipXb/856j5Ftl/MpJtLb5r8CwXeVOekUepqq31niJGt+su1cRNzYCRZwaONHj16yH/1Oa37+/trfchK+Pn5OTk5ma9R0K9BgwbqjpMIDw9v0qSJVtXJUNaIEaZDjNCRuWKEhW3YsEHZyTcuRsQniFcZ9fdJdm5Upot48K+K8IgU773UaJj2fbzFNvvmKZ/OEjcnVBk5wflyxd/iAYr+Qh0/ouVbVSjORFu2bDHqe1+mTJlbt25Z4VRLeoSEhBQoUMCoavK1QqFChSpVqlS3bt3GjRvzdYOrq2ujRo3q1KlToUIFBRes7u7uaj0SSk5O7tmzp7EHYG6IEWkQI3QgRujRsGFDZSffiBiRQil/HjCwzmSe1uJ1iau3lB3M/5eYJBYKn7xGvN1gb+hiOuttNq5iHoiWX9Ef+yn0vqnzY/LJ3HGMWn5t4B5SiU50I8zUD85EUVFRxg4XqF69+ooVK6KjreCpjASu4IcffihZNW6Uq1Wr5uXlxenq/Pnz9+7de/HiRdqM15yc4uPjnz9/fvv27ZMnT65evbpHjx6lSpWSfAcsZ86cM2fOTFLjBhRfwfDejPrILCC7xQhbW9t8+fIVLlw4bboh7q2rVKlStWrVd999V/+atIgROlSJEXwe8ufPX6xYMW7NOOi7uLjwx8EtFf+XzwD/uYpjHfjXV7BgwbSynJ2d08ridoP/W7ly5dKlS8s/KebDvnr1qoKTb0SM2HOKKvfW1w/V+4x+3SNmbjDFo2diJx9PEkP/NO/ONd/smokpur9cQscuUYxp0whFRNO4FeLVDD3FtfnW1FJMx+0at4ZG/ZAcHBw6duzITXNkpDnnJDEZ9/2jRo2SqRFfRLZv33779u2PHz+W3DlngqCgIE5U3HbIFFG0aFHT33bhrkVyhAfXqEaNGp6enuPHj1+1ahUHo927d+/fv9/X13fPnj3btm3jOPLjjz9OmTJl2LBh7dq1a9CgQaVKlQoVKmTsuwlpVI8RtWrVcpPDec5guYpjRJ48ebi34INp0aJF3759+WT+9NNPmzZtOnTo0JkzZwICAtImP+bE+eDBg0ePHoWHh78+88SrECN0GBUjChQoULZs2Xr16rVq1WrAgAHTpk3jj4N/tvzLOnv27OXLl69fv85BPywsjD8O/i3zf7n6/Of8BRg0aJBR9xE5DXAi4VzINR06dCj/UtasWcO/HS7L39//ypUroaGhd+7c4bIePnyYVlbaDNynT5/ma4a6devKlDJ9+nQFS/PIxojkZPEa4ZsuZ/nPOWFcuG7SdTP/2wP+1H2qmBZTw2mjrHDjs1GiM43+me6bNjYuMYlG/6RvMXdbN1q1w2IzlGcsIiKiW7du8r+uV3/Sw4cP55+olkevF18XyjzOyJ07Nzcx8gFCx8mTJxs1aiRzW4IbPlPmuIyKipKceJQDxOTJk7ml0zMno44nT56cOnVq7dq1EydObNu2bZEiRYzKE6rHCHUnwzY2Rjg6OnJu+Pzzzzlp7d27l/sG/eFAHmKEDvkYwX356tWr9+3bxzWS/2Kn40+Q9yBTUL58+fijX7lypZ+fHycDBTcR+QKGG5+3337bYFl89cJFGLt/2Rgx7483du25W4lXJyJMWGQkNo5+2UVV+iA9GNgcWohVwvefNWkq8YvXqe7ANxZR0ENMA6ot/iW7uLjI/MAyxP/Wy8uLL3YV/B7Mhy8QZSpVsmRJvrZQ0Cq9isMB974GnzVw8zRv3jzFpaxYscLgvVm+hFq6dKmJ1aHUdpBP4IYNGzp16iTzHcgaMYKvPjdv3hwcHGy+0T+IETqUzWKpDAcCTocGC8qTJw9fG5hYFluyZInBsgoVKqRgDgmpGBF0R2SFDHudUp5i1gHF3/E7j+ibZeTYDgFCdktbtqPRMPrRR/l6308jxdKmOd4wRdX7n1t62dXXqTUTIrcInp6eo0eP/vPPPwMDAzVcSpuPweDRFi9enC80VSmOW6jJkycbTBJ8gaJsrCV3Btwl6N/5u+++q/qEV1rNYqlJjMhwMmx1IUbosGSMoNR7hzJjFxYuXGh6Wc+ePZN5fXTVqlXG7tlwjHj8nAbNzbi/qdRLzOKQoOh7fv+JWKfb1UusW61535zpNg4TBTyo62SxrEmEosGFL6JSpvwihsS+vvNcLcXwFG1xf+/j46PW7Ey2trZFihSpVq1aq1atxowZw03JmTNnlN0eVOb+/fvVq1fXf5CcIfjCXcVCub2WWaaEA5aCna9cuVJ/k+To6Lht2zbVL6MRI9SFGKHDwjHi4cOHVatWNViWWqsIyQycmjBhgrG7NRAjkpNp6q9k31y3p+EL4h5TxcB+Y1sJ3uHlm7RwoxhLgTsQpm/524ipMDceFFNEGCs5RfxD5x4ZfBBVPtH+0QalDiZo0KCBzE/aWHwF4OLi4u7uPmPGjP3793PbYdZIsWjRIv2P9rn9nTdvnup9Bl9/VKpUSf+paNSokbGdfUhISP369fXs087Ojhsjc5xSxAh1IUbosHCM4J+ep6enwbKqVKlielkkNzFP9+7djd2tgRhx97G45aB7KdyU+s9Uckc9ITFl0WYq/TEChMqbQwuq3pcO+iu58gu6Q+8Nfu0jdqWO4xTsTH2PHz8eNGiQWady451zw9G7d28fHx9zPIR+8OABd9X6j6F69eqKx1Tqt2rVKv1Fc765ft24uWanTJmif30g7v+M3ackxAh1IUbosHCMYOPHjzdYFp9Y0wcYsXHjxhksy9XV1diyDMSIa/eodJf/6WAKtKHp64xezCkpWQyirNFPTJioeaebVTc7N+ozncOE0beIbj8kty9198Z/YiX4O71169batWvL/LZN5OzszH3kqVOnVPnRplm2bJnBx58zZ85UqzgdsbGxxYsX11/6woULjaqvwQc03t7eZhoViBihLsQIHZaPEStXrpQpTpU57BctWpQ7d279BdWvXz8qKsqo3RoXI0p6isW+jRIVS2t3U7U+2vey2WTL0Yw+GkNH9E05k4EX0fTDJsrxSsiznhiRbs+ePR988IHMT85EfIHeuHFjbnG4Dzb9sA0e87vvvhscrNK0rxmZNGmS/psHXFn5sZCBgYH6q+Po6GjKe6T6IUaoCzFCh+VjxO7du2WKCwoKMr2s9evXG3ztU8GdUSNiRI3+YhFqeQmJYu3K9z/XvmfNhptNU/rke7onvgxGXBQu2UK5/2/EqxXGiDR79+5t3ry5iUsWSapaterp06dNubB+9uyZwQkPpkyZYtbegjuAKlWq6DkAbv05oknuzeBrYx9//LH56oIYoS7ECB2WjxF+fn4yD23PnDHyCj4jW7duNbiyuYLPSDZGNBlOoWGys0txq3s2SLxHUKKT9h1qdt4q96aZ3kZMcZ2YJF69qdBD/FurjRGUup6kr6/v9OnT33///fz580vOAK1M4cKFhw8fHhISouxQ//77b4NFHDp0SN3zo4O7IoNDqzjKSO6te/fu+nfFOcN8dUGMUBdihA7Lxwi+UMmbN6/B4g4fPmx6Wbt37y5VqpT+gt555x0+CUbt1nCMqNSLOoyjR3JnLClZ3IH4aikVllhJHJsFtrQJRpf8JQZASDoRSLU/teoYkS46OppD+urVq7t06VK1alXz3aKoVq3arl27FEw78fXXX+vfc86cOWNiTJi7TY7B3oJbYckXKwy+hWuwvzEFYoS6ECN0WD5GnD9/vlChQgaL27t3r+ll8RevdOnS+gvinGHsVZOBGHH9Hn27XEwSJSMhkbYdpaqYjNL6ttwtqdXXRixBvuNYymDl0xtqgDv4ixcv8nXwRx99ZOySHJIqV668ZcsWYw/Mw8ND/265VzbHCdFx8OBB/U187dq1nz17ZnA/UVFR+p/R2NnZmTUVIUaoCzFCh+VjREBAgEyTtXv3btPLkokRJUqUMHYchuF5IyRHcP9zWkw2YIsXMax142yXs7lY5evyTakP1NiXcawHX1UHBgYuXry4f//+ZcuWlWkRJHEruXHjRqMOxuBcnB9++KGZzsOrrly5ov99DScnJ5lhnqdPn9ZfHe4nzFoRxAh1IUbosHyMuHTpUpEiRQwWt23bNtPLkowRxq7zacQKnxlKITp0nj6eaKV3IGxe+982/7fZuYm5m4q0F4M/nHtS1b5UZyDVH0QNh9IHw6ipl7irn7Y1GUENh4mt7kCq9alY+6N8Dyr5Mb39kZjwkZOTzSu7feuVUjSvfoZbPncav4peGPdGTyZ2/fr1zZs3DxkypFatWqavz2tvb+/n5yc56DIiIsLgDjt16mTuM8DCwsL0r+jh4OBw/Phxg/vZsGGD/uq4u7ubtSKIEepCjNCRtWPEzp07DV7YWDpGRMTQ6p3WchOCu+3crUXXXqYrufQRmaDxcHL/hrp/R0MX0Lc/0Qxv8SbC2t205ZBYB+TwBTp+SYzkOBcsVqsKvEFXb1PwHTEc5Po9MSzx5oP/ttD74g95C7pNV27RpRt04RqdDaaTl8Vc1Af9afsxMR0kn4oFf4pJP79aSgNmi2jV7Et6fwjV/FTEFI4dBduKhb81P1G85XWntqPFkas3OYK1i4yM5Cty/ikOHz68adOmRYsWVTwws3nz5pLriAYFBRncG/+qO5mfh4eH/rkr+GzI3DVdvHix/ur07t3b5M9KH8QIdSFG6MjaMYJ3YvBNDcvFiIRE2npULBDl0MKi/V+O5mKd6wo9qPYAsR4HR4Qvl4jVRzkc/HOKTl4RgYB7/bCn4mpb2WIfKuJL1tg4sczVnUcUcpf8Q0R22e5HP/9NU9bSkPliggfOOtX7iejDIcPCc3Plb0MjFokDyz5hIk1sbGxAQMCaNWs8PT2LFSsm02To6Nmz58uXLw0WdODAAQU718ratWv1VycpKcngjHsjR45U50N6A8QIdSFG6ECMsFCMSE6hFdvFspyW6e3yuadU7kUe39KIH8QdhQ37xT2AG2HapwRVRMWmXL4pJvX6ZRdNWk19Z5Cbl1g3Nedr65iYY7NJXc/zgL/yNVoztYSEhM2bN/OVuoODg0zDka5w4cL+/oYXHfHx8TFqt9oy+KImxy8vLy/9O5k4caJKH07GECPUhRihAzHC7DGCL693HhfLN5jpwX+ulmLC7G7fiddDuFvla3e+js9u18ppEpLEahd/+4kFwYcvpNbfUPluZGue027fQjz3uXZP6zprh3/J7dq1M2rkxODBgw2OkJDs86zEjBkz9FcnIiLis88+07MHPoEGd2IixAh1IUboQIwwb4y4els88lfxKjlPK6rRlz6ZTjPX09Yj4mFE9kwM8iJj6EwQee+lUctSOo2nsl3VzHN5W4ul2zPvCxom4vb68OHDRYsWlWlBWNmyZfft26d/n/JttDUwOAMVt5v9+/fXswfuRST7b8UQI9SFGKEDMcJcMYIvunz9xTqQDi1N6qgcWtA73cSLD31m0OIt4mbD5Zv0NNLopaTgZbxYGdw/hDYdFCuldZog3jEp0cnU2xUF2tKguSIvZk8pKSlr167NlSuXTCOSM2fO8ePH699hFosRERERAwcO1LMHW1vb77//Xr0PJAOIEepCjNCBGGGWGBFylyavEQMAFXRLds3EY/4Gn1O/mbRyB/ldEmMauAsEdXEOi4wR3f/O42LAqedE8WKq4olEK/USNzwiorWulRY4SYwZM0Zmbtq3Uqds0r+3X375RWY/VsJgjIiJiRk+fLj+nfDZU+/TyABihLoQI3QgRqgfI/iS94Ohxt05t2kqNsd24nH7Zt8UTiExhoe0g5qSU8TrIQGhtOJvMXll7pbiE3mrqTHPm1pT5prFUkXcOjRv3lymHeFGU/+MjZs2bZLZj5UwGCO4S+OUoH8nn3/+uaqfhi7ECHUhRuhAjFA/RugsFP7G6JC6FetIHqPFetNHLlJ8lniNImt4FikmKZ+0RkxiYddMNhRmijU1zGTp0qUy7QjT/77G/v37JfdjDWRW55o1a5b+nXTs2FG9zyEDkjd4ECMkIUboQIzQIEbwZWubUTR1rRj6J7n+J2joyQvac1JMF1Gtr4GpNrNzjJBcc49t2rRJz35kpp8qW7bsbOtw9OhRg2fmt99+01+datWqqfc5ZGDZsmUyn8tsxAg5iBE6ECMsFyMKeIi5pxZupIdPTagTaOryTRowi1x6i/dsESNeFRISYnA53TT651qIiYnRv5AVq1OnjsXqZbqDBw/qr469vb2CdVDlzZ07V+ZzQYyQhBihAzHCvDHiv8cW34rHFmeCKBojHjK/lBS6H077z5LXYvHII6+7tcSIZE3f/eWm5J133pFpSqZPn65/VwabJP7RWqZSqrh9+7bBc3L27FkzlS7f6yNGSFIxRixYsMDgNG7ly5e/deuWOSqCGCFDsxhRtqtYv6rdGDF6/1IoxZvxSgM0kyLm06TjgWKW7kbDRZ7QMEbExcXNnDmTL3y1OoDg4GCDC9ikMTieoEuXLvr3YGtr+/jxY8vUy3Qc7wxOrWEwWikWHh7eq1cvmc8FMUKSijFi0aJFBl+WLlOmzPXr181REcQIGdrEiLuPxYSSG/ZRLN7SzDbuP0mZ/yeNX6nZAZw4caJw4cJVq1a9ceOGJgdw7ty5AgUKyDQlBmPEtGnTDO7E19fXItVSx4cffqi/Oq1btzZT0aGhodyzynwuiBGSVIwRP/74Y548efTvREEXJQkxQob2s1gCWAD/qN599920L3SFChXu379v+WNYv369TDvCFixYoH9XHIkM7uSbb76JjY21TNVM99133+mvjp2dnZluXHPekhz6ihghScUYsXr1aoPhO3/+/GZ65oUYISMbxYiYl/TgqViw6kQg7T0t1vX23itWxfxhE83ZQNN+FTfeJ6+hsSto/Crxv6f+SrPWi/GeP/1Nv+4hnyPiYf+Zq2KN76hYzabITE6hx8/F2uLHA2nXiZRNvmIl8SV/0bw/U6avE4fNG1dh3Er67hfxv/kP5/0hJvdcuUPc/tl6hA6cE4uYh9yl8BeUlD2mCY+Ojq5Wrdqr3+nKlStfuXLFkseQkJBg8ElEug0bNujfW3JyssHnI/y7PXbsmGVqZ7rTp08bPC0jRoyIiIhQvWiD64umQ4yQpGKM2Lhxo8EHXra2tvv37zdHRRAjZGSdGMH9etpczldv09kgsbjlur00/0/6Zhn1m5nSLnXt7PqDxfLZFXtRmS5iXOfbH1G+NuKFgpzNM1hNm/8kRzMxUTf/nULtqHgnKtuNKvemOgPF6yTtRosJnieuolU7RSjxDxHLfUWpd+2XNtdT6H06dYX+OkxL/6JRy6jXNGrxFb33OdXoT869qNTHVLSjmGo6d2uxDpZtswzejLB1E/+v3K0ov4dYDL1EZzFxuMsnVPNTMQ2omxd1niDWFp+0WhTBBR06Txeuiaj05IVYxytrWLRokY2Njc7XmhtTmeU01XLgwIHy5cvLtCPsyJEjBnfYu3dv/e9rcJW5g9R2VKm82NhYg62ek5PTnj171C03MjLS4POUdKrHCHWrkyVjxM6dO2VGFBnsyJVBjJCRKWMEJ4bnUaKLPRNEW4+KGwZei8VozYZDyaWP6Cm54389Fphv47K4L3fuKWJKjyk0/w/acUwspGnUWyecG7jn5i58w34a8zO1Hytmni7TVUQEi1XkrdSJxjkzlesukkrTL+jjSTT2Z1qzk/45RReui6gUE2e2z9UMuBM9fvx4/vz5M/xmV61adceOHUlJZo9LcXFx3Ha/HmUylCNHDpmm5ODBgwYbplKlSl28eNHctVPLkCFDDK6G2rhx40ePHqlY6ObNmyWXO3lLOkbwN2rcuHEyO9y6dauKdcmSMeLEiRMVK1Y0uB8vLy9zVAQxQkZmihGcHq7fFw8X5v9J/WeJtbhKdPpvsiMzrTCuJFKkbjmbU73PaOhC8Rwh3NBdWA4QAaHiZkCPqVShh3VVJ71GOZqJY2s9Sswx9fPf5Hte3Pix/onB+Nfr7u6u58tdvHjx3bt3m/swuAjJDPFW6ttrMvvkaNK1a1eDexs9erQFchKlvu+wa9cug6uc68GRzuB1Z86cOZcvX67WMT98+NDDw0Pyc3lLOkawqVOnyuzQ29tbrbpQFo0RwcHBNWvWNLifli1bmmMkEGKEDKuOEVGxorua+wd9NpfqfiYmp7K2LlamD+YOuMHnYqRF8J3/qV1sHO09RcMWklPnTFav9OhW0pNcveirpSIt+YdY3Vu7MTExnp6eBn9Itra23333nflmNwoKCipcuLBMC5J2MCNGjJDc86FDhwyODeS/YO51rdjdu3dr1apVoEABU+7SJycnDx482OAp4lJWrFhh+jFzDmvatKl8vHvLmBixaNEimR3yF0/FHj1Lxgj+Fcu8R8O9lLq3dtIgRsiwrhgRF09HL9KCjWIQQPkeogPOXP2r/i1Hc6rah370Ib8A8dgi/VaK5gdm4pZei3xtxGRTHIx+/1cM4bTINbA+c+bMMTjbY7rKlStv377dlIvp1/HeuH2RnCsiTcWKFU+ePCm5f44+3bp1k9mt/mkxTREfH//HH3+kNyLOzs6mvMEfEBBgcDxdmgEDBphy9cmdU9u2beU/lzTyMWLDhg0yO6xSpcr58+cV10JHlowRlDoMSGZXHh4eqlcEMUIGBziNY0RkjLhM9zki3i9o9bW4c57hJMpZZsvfhpx7kEML7Y/ETBtHisIfUa3+YlzF4i3ixZA7jzR4JYQ7MxcXF5nfbRq+Ki1fvvzixYvVequQ+9c///xTsu1I16dPn5cvjRhTs2PHjnz58hncbbFixfhv6l84VIFHjx5NnTqVd55ekJ2d3ciRIyMjI5XtMC4u7pNPPpE5UQ4ODoMGDeLIZewjG852Fy9eHDZsmMEpll8nHyMMTu+dfrpGjBih1ueSVWPExIkTZXbFPwTVX79CjJAh8zaN+jEiMYmu3KK//cSD9ncHiXvjGb5lgC0LbDmbi8GnHBC/+4V8/cXMY5Zx9+5dyTmFXsVdC4eJWbNm8c9e8WMObqMPHTrUuXNnydkI0jk6Ohr7iiaHlQkTJsjcdClQoEDfvn2vXbumrFI67t27N2fOnPr1678+KDJPnjzcSSt+QyQwMLBChQqSZ4wTzKhRo/iCXvLDunPnzsKFC43NdunkY0RYWJjk4xJ7e/tu3brt3r07KCiI/9UTvfTfLcuqMeKvv/6SvK3IVXv61NQFmfiry6eav1ScvKtUqSJTbjaPEXy9ZLAs9WPErYdUsz/ZWfBlCmzWsOVqSV0mmfBtNRL/kBR3GPwPP/3009DQUGMLDQ4O7t27N18YGfXQPU3Pnj0VZBdOEq6urjL750NycXH57bffTHl28+zZsxUrVlSqVElPQZzGFA9c5WPbvn27UWePm7AuXbpwN6xnt1FRUZMnT3Z2djb4Moge8jGCa/HqTRqD+KicnJz406mhV1ycvhelsmqMCAgIkB9d1LFjR2VZOTo6+uzZs3wJ0bZtWz7VnOnlH4kiRmgQIwwuFI4tq24WXlPj0KFDdevWlfn1ZihXrlzc5k6cOHHfvn0PHjx40xU296z8F/jqvHHjxgpulaepVauW4sfkV65cedNLrRmqXbs2N/RGTeX58OHDzZs3Dxw4UKZteis1h5lyXfjVV18ZewK50efPetiwYatXr+brSP7od+3axZlpzJgxrVu3Nur8vIl8jGDcn5leog79D7yyaoyIiIhIn4JWRtmyZZcuXZrhmp9ccf4mc+I8ePDghg0b5s2bN3ToUM4NVapUsbe3ly9CB2IEYgQ2y22WX5orMjJSwWC6DBUoUKB69eqcFdzd3du0aePm5lazZk3+/Si48aCjUKFCwcHBplRz586dxraD3O9Wq1Zt8ODB3Jj6+Pj4+fmdO3eOowz/9+jRo9y+cGcwbty4Dh068FWygjq2a9fuzp07hg89I9zcN2/e3NgSzc2oGCE/97m87Bkj2KRJkxScroIFC3Kk4P6b/1u0aFFl9whlIEYgRmCz3KbJCp/caHbp0sXgAj9a4e6ff4emV3PTpk3cbmpdm/9wRvHy8jJlldGwsDBnZ2cLHCp3LTlz5pT5m0bFiOjoaNU/jmwbI06fPq3K/SQzQYxAjMBmuU2rhcIjIyO9vb1lpsOzMG5c5s+fr8oMUdw3rFy50tHRUes6iVGWEydONP0FhMDAwEaNGpn7aOvXrz9o0CCZv2lUjKDUVwyMHWarX7aNEbGxsZKv8GgCMUKDGPEimrz/FZMh8rb4L/phMy3YRLN/pxneYjWpcSto1HL6YhENnk99Z1CXyWJm6OYj6cMR1GAI1R2Yui5GTyqbui5GgTZk3zwrzL5gtZutK+VpRYXaiokuyqWuKlKzP737mZh63NVLvILRcbyY56P/LBqygL5cQqN/pomrxXRbM9eLqcP4w+Vt2db/Pu7tmq4Vxd/jYcOGST7dNze+Xm/cuPHJkydVnKyC48imTZvq1aunVaXs7OyaNWv2119/qbWWR0hISMuWLU0ZF6lf3bp1/f39uRuQ+cvGxoiIiIgvvvhCxYPPtjGCPXnypEaNGiacPDNCjNAgRijALW18ophY+tYDunyLTlwWi29tPiQWrpz3B01YJTJH96kibXDIKOmZutqW6/9smvfH1rnpnKVcrcSCGu8PoTbfUp/p4o1cDnZLttDa3WL5koP+Yh2T4Dt074lY1iRR6wmmFOA+29vbu0yZMjI/abPy8PAICAhQvYLcf58/f16T+y42Njbu7u4mDvJ4HZ+lzp07m+OA33vvvX379nERZooRLDQ0tHr16modcHaOEez333834eQZrWjRoqVKlZL5m4gRmSNGGCspWSyofSmU9pykX3bR9N/EjNrtxlK1vqkLd2XLeJFeZafOYrqOLpNp5FKxkNjGg3T4gph3UsUVSq1cbGws//IbNGhgpiFX+tWpU+fAgQNmrWBkZOSgQYMKFSpksUo1bNhw9+7d5ptTfO3atcWLF1fraB0cHCZNmhQfH5+2c/PFCEpNEkat3KFHNo8RbMaMGSacPyncJtSrV4+7xqioKEw/JSPLxgg9UlLo0XMxI/WG/TRpjZhssd5n4r59VkoV6YnBsR19+IWIULN/F/N9+Ydko6xgUFJS0pkzZ7y8vN5++22ZX7iJcufO3bNnTw4Q6k65rce1a9d69Ohh1rGl9vb2rVq1UqUxMoiz0fr162vVqmXKAefNm/frr7/WuWVi1hiRZvv27abflkCMYHv37q1ataoJZ/GNChYsOGzYsJMnT6afH8QIGdkxRrwqKZkePROLeh/0pxXbxYLjrl7i8X/aMmCapwGj04MbFe1IdQZSu9HiQc+GfeLpz40wioghS/VcmU90dPThw4fHjx/fuHFjzhOq35/gjpZbvSFDhmzevFndRa5lPHjwgMt1c3OTXw5bkpOTU8uWLdeuXav4rU4FOPkFBARwd859YYECBYz6sAoVKtSiRQtvb+8XL17o7NYCMYKzY2Bg4Ny5c/mklSpVysHBQcE5R4yg1O/AsWPHOnXqZNQEX3pwenjvvfcmT57MEV9nHnfECBnZPUa8LiGR7j+hs0H06x76Zhk1GS5GWthb8RIYeVqL4SAeo+n732j3CQq8KUYtqDS+LXvhPMGN2pYtW0aMGNGoUaPKlSsb21Gl4Q67TJky9erV69at25IlS3x9fR8+fKht1WJiYg4ePDhhwgQ+Kq6UsTVKx/+2Vq1a3IKvXr2aL+jNsTSzfI3OnTvHzXe/fv3ef/99Z2dnTgk6c3/x/+no6FilShV3d/cZM2b4+/u/aRbIo0eP9pewc+dO04+cj+HatWvcEXICmzJlysiRIwcMGCBTOtP/zIgDlsxO+FSoNQD2TfjLJlmj27dvKyuCE9Xly5dnzpzJ6Z97aMlXdtO/GByC69at26NHjzVr1pw/f/71ZJlmwYIFMrXg74/+o33y5MmoUaNkdqXWAiv37t3jdsxgcfwjMr2skydPGizryy+/DAsLM2q3mThG6HgRTTuO0dS11HiY1YWJUp7UYSwt+Ysu3xSLo4KKuFk5c+YMd5Zjx47t1asXX8C5uLgULVpU5yLS1tY2X758xYsXr1q1KiePLl26cK+waNGif//9l3/G5m6sFbhx48aqVav69u1boUIFyYTEdeRLDVdX12HDhvG/5fSgyuupauGr/PDwcO6VOVLMnj2bG+shqbjZmjVr1rp16zgamm/EBmju2bNnnNSnT5/OfdUHH3xQqlSp15/i8Vc9f/78ZcuW5R/yp59+OnXq1O3btytOMGAZWSdGvCoqVgzYHDKfyncTr0FqEh3s3MRjl1nr6czVTPmiRNbwMpW57wybW3R09MWLF7dt28YXZPPnz5+das6cOT/88APHhS1btnDrfOXKFf5rWh8pgHH45/n8+fOHqfiSIH0sLWQiWTNGpEtJoYvXaezPVG+ghdKDQwtqO5pW7aCwcK0rDwAAYGZZPEakiY2joNu0cBM1GUEFPcwVIJw6izm4ft9H9x5jmCQAAGQL2SJGpOM8cewSDZpLlXqp9n6HfQv6YKiYC5KTCtIDAABkK9krRqRJSqa7j2nkktQk0dSkDPH2R7R8q3jhAgAAIBvKjjEinV8A9f5e4Uofed3FHYinkYZLAQAAyKqydYxgKUSHzlOT4SmSSYL/Wt7WNHge3bH07EQAAABWJ7vHiP+TMnUt5W5lOEaU60bb/bQ+WAAAAOuAGPGfpCTaeIBcepOtW8YBwq4ZffI9XbtLyRhHCQAAkAox4n/ceihGS+RsrpshCnjQTG96iZlRAAAAXoEYoevuY2r6xf8MusznTjPWpSRZ3XTJAAAAGkOMyMCLaDoaIIZepm2BN7U+IAAAAKuEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoBBiBAAAACiEGAEAAAAKIUYAAACAQogRAAAAoND/A11nGZqS3T6wAAAAAElFTkSuQmCC";

// error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.png" />
  <title><?= $meta_title; ?></title>
  <style type="text/css">
    .bg-selected {
      background-color: #949494;
    }

    body {
      top: 1cm !important;
      left: 0cm !important;
      right: 0cm !important;
      margin-left: 0.5cm !important;
      margin-right: 0.5cm !important;
      margin-bottom: 0cm !important;
      margin-top: 0cm !important;
      font-family: "helvetica";
      font-size: 7px !important;
    }

    .titleHead {
      border: 1px #000 solid;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;

      background-color: #a6ffa6;
      font-weight: bold;

    }

    .titleHeadMain {
      text-align: center;
      border-collapse: collapse;
      text-align: center;
      vertical-align: middle;
      font-weight: bold;
    }

    table.table td {
      border: 1px #000 solid;
      font-weight: bold;
      max-width: 150px;
      word-wrap: break-word;
    }

    table>thead>tr>td,
    table>tbody>tr>td {
      vertical-align: top;
    }

    .br_break {
      line-height: 15px;
    }

    .br_break_no_bold {
      line-height: 18px;
    }

    .br {
      border-right: 1px #000 solid !important;
    }

    .bl {
      border-left: 1px #000 solid;
    }

    .bt {
      border-top: 1px #000 solid;
    }

    .bb {
      border-bottom: 1px #000 solid;
    }

    .bx {
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }

    .by {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
    }

    .ball {
      border-top: 1px #000 solid;
      border-bottom: 1px #000 solid;
      border-left: 1px #000 solid;
      border-right: 1px #000 solid;
    }

    .tab {
      display: inline-block;
      width: 130px;
    }

    .tab2 {
      display: inline-block;
      width: 130px;
    }

    .text-nowrap {
      white-space: nowrap;
    }

    .valign-middle {
      vertical-align: middle;
    }

    label {
      display: block;
      padding-left: 2px;
      padding-bottom: 5px;
      padding-top: 1px;
      text-indent: 1px;

    }

    input {
      /*width: 16px;
            height: 16px;
            padding: 0;
            margin:0;
            vertical-align: bottom;
            position: relative;
            top: -1px;
            *overflow: hidden;*/
    }

    input[type=checkbox] {
      width: 16px;
      height: 16px;
      padding: 0;
      margin: 0;
      vertical-align: bottom;
      position: relative;
      top: -1px;
      *overflow: hidden;
      /* Double-sized Checkboxes */
      -ms-transform: scale(0.8);
      /* IE */
      -moz-transform: scale(0.8);
      /* FF */
      -webkit-transform: scale(0.8);
      /* Safari and Chrome */
      -o-transform: scale(0.8);
      /* Opera */
      transform: scale(0.8);
      /*padding: 1px;*/
    }

    /* Might want to wrap a span around your checkbox text */
    .checkboxtext {
      /* Checkbox text */
      display: inline;
    }

    textarea {
      width: 95%;
      height: 250px !important;
    }

    .button {
      background-color: #4CAF50;
      /* Green */
      border: none;
      color: white;
      padding: 10px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
      border-radius: 10px;
    }

    .button2 {
      background-color: #00b52a;
      color: white;
      border: 2px solid #00b52a;
    }

    .button2:hover {
      background-color: #017d1e;
      color: white;
    }

    .button3 {
      background-color: #d4ad00;
      color: white;
      border: 2px solid #d4ad00;
    }

    .button3:hover {
      background-color: #e6bb00;
      color: white;
    }

    .button4 {
      background-color: #d42626;
      color: white;
      border: 2px solid #d42626;
    }

    .button4:hover {
      background-color: #cc0000;
      color: white;
    }

    .page_break {
      page-break-before: always;
    }


    div#page3 {
      -webkit-transform: rotate(90deg);
      -webkit-transform-origin: left top;
      -moz-transform: rotate(90deg);
      -moz-transform-origin: left top;
      -ms-transform: rotate(90deg);
      -ms-transform-origin: left top;
      -o-transform: rotate(90deg);
      -o-transform-origin: left top;
      transform: rotate(90deg);
      transform-origin: left top;
      position: absolute;
      top: 0;
      left: 100%;
      white-space: nowrap;
    }

    .table {
      word-wrap: break-word;
    }

    .wtr {
      border-collapse: collapse;
      width: 100%;
    }

    .wtr td {
      border: 0.10px solid #000000;
      word-wrap: break-word;
      text-align: center;
    }

    .wtr th {
      border: 0.10px solid #000000;
      word-wrap: break-word;
      font-weight: bold;
      vertical-align: middle !important;
      text-align: center;
    }

    .color_pending_client {
      /*         color: #ff0000;*/
    }

    .color_pending_QC {
      /*         background-color: #6bff93;*/
    }


    .color_date {
      /*         background-color: #ffff00;*/
    }
  </style>
</head>

<body>

  <?php $no_max = sizeof($show_data_irn_list_filter);
  $no = 1;
  foreach ($show_data_irn_list_filter as $key => $loop_val) { ?>
    <table width="100%">
      <tr>
        <td width="15%;" style="padding: 10px; border-right: 0px !important;">
          <center>
            <img src="data:image/png;base64,<?= $img_sembcorp ?>" style='width: 160px; '>
          </center>
        </td>
        <td style="padding: 10px; border-right: 0px !important; border-left: 0px !important;">
          <center>
            <b style="font-weight: bold; font-size: 20 !important; vertical-align: middle !important;">
              <?php echo $project_client_description[$loop_val["project"]] ?>
            </b>
          </center>
        </td>
        <td width="15%;" style="padding: 10px; border-left: 0px !important;">
          <center>
            <img src="<?php echo $client_logo[$loop_val["project"]]; ?>" style='width: 160px; height: 50px;' />
          </center>
        </td>
      </tr>
    </table>

    <center>
      <span style="font-size: 15px !important;font-weight: bold;">
        MATERIAL & WELDING TRACEABILITY RECORD - <?= strtoupper($discipline_name[$wtr_list[0]['discipline']]) ?>
      </span>
    </center>

    <table width="100%">
      <tr>
        <td width="40%">
          <table class='title_desc' width="100%">
            <thead>
              <tr>
                <th style='text-align:left !important;'>PROJECT NAME</th>
                <th>:</th>
                <th style='text-align:left !important;'><?= strtoupper($project_name[$loop_val["project"]]); ?></th>
              </tr>
              <tr>
                <th style='text-align:left !important;'>CLIENT</th>
                <th>:</th>
                <th style='text-align:left !important;'><?= strtoupper($project_client[$loop_val["project"]]); ?></th>
              </tr>
              <tr>
                <th style='text-align:left !important;'>DRAWING NOs</th>
                <th>:</th>
                <th style='text-align:left !important;'>
                  <?php echo $loop_val["drawing_no"]; ?>
                </th>
              </tr>
              <tr>
                <th style='text-align:left !important;'>REV</th>
                <th>:</th>
                <th style='text-align:left !important;'>
                  <?= @$drawing_detail[$loop_val["project"]][$loop_val['drawing_no']]['last_revision_no'] ?>
                </th>
              </tr>
              <tr>
                <th style='text-align:left !important;'>DESCRIPTION</th>
                <th>:</th>
                <th style='text-align:left !important;'>
                  <?= @$drawing_detail[$loop_val['project']][$loop_val['drawing_no']]['title'] ?>
                </th>
              </tr>
            </thead>
          </table>
        </td>
        <td width="60%">
          <!-- <table width="100%">             
                            <tr>
                                <td style="text-align: center;">
                                    <center>
                                        <span style="font-size: 15px !important;font-weight: bold;">
                                            MATERIAL & WELDING TRACEABILITY RECORD - <?= strtoupper($discipline_name[$wtr_list[0]['discipline']]) ?>
                                        </span>
                                    </center>
                                </td>
                            </tr>   
                        </table>  -->
        </td>
      </tr>
    </table>

    <table class="wtr">
      <thead>
        <tr>
          <th rowspan="3" style="width: 75px !important;"><br /><br />Drawing/Weld Map No</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Rev No</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Joint No</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Class</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Type Of Weld</th>
          <?php if ($show_data_irn_list[0]['discipline'] == 1) { ?>
            <th rowspan="3" style="padding:2px !important;"><br/><br/>Spool No</th>
            <?php } ?>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Weld Length</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Size / Dia</th>
          <th rowspan="3" style="padding:2px !important;"><br /><br />Thk<br />(mm)</th>
          <th colspan="12" style="padding:2px !important;">Material Traceability</th>

          <!-- BUTTERING FOR EQUINOX ONLY -->
          <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
            <th colspan="1" rowspan="2">Buttering</th>
          <?php } ?>
          <!-- BUTTERING FOR EQUINOX ONLY -->

          <th colspan="3" rowspan="2">Fitup</th>
          <th rowspan="3" style="padding:2px !important;">Tack Weld ID</th>
          <th rowspan="3" style="padding:2px !important;">WPS No</th>
          <th rowspan="3" style="padding:2px !important;">Consumable / Lot no</th>
          <th rowspan="3" style="padding:2px !important;">Welded Date</th>
          <th colspan="2" rowspan="2" style="padding:2px !important;">Weld Process</th>
          <th colspan="2" rowspan="2" style="padding:2px !important;">Welder ID</th>
          <th colspan="3" rowspan="2" style="padding:2px !important;">Visual</th>
          <th colspan="12" style="padding:2px !important;">Non Destructive Examination</th>
          <th rowspan='2' colspan="3" style="padding:2px !important;">IRN to B&P</th>
          <th rowspan="3" style="width:50px !important" style="padding:2px !important;">Remarks</th>
          <?php if (isset($for_mwtr_signed)) { ?>
            <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "0") { ?>
              <th rowspan="3" style="width:50px !important" style="padding:2px !important;">Action</th>
            <?php } ?>
          <?php } ?>
        </tr>
        <tr>
          <th colspan="6" style="padding:2px !important;">Part #1</th>
          <th colspan="6" style="padding:2px !important;">Part #2</th>
          <th colspan="3" style="padding:2px !important;">MPI</th>
          <th colspan="3" style="padding:2px !important;">PT</th>
          <th colspan="3" style="padding:2px !important;">UT</th>
          <th colspan="3" style="padding:2px !important;">RT</th>
        </tr>
        <tr>
          <th style="padding:2px !important;">Piece<br />Mark</th>
          <th style="padding:2px !important;">Mtr No.</th>
          <th style="padding:2px !important;">Grade /Spec</th>
          <th style="padding:2px !important;">Unique No</th>
          <th style="padding:2px !important;">Heat No</th>
          <th style="padding:2px !important;">Thk / Sch</th>
          <th style="padding:2px !important;">Piece<br />Mark</th>
          <th style="padding:2px !important;">Mtr No.</th>
          <th style="padding:2px !important;">Grade /Spec</th>
          <th style="padding:2px !important;">Unique No</th>
          <th style="padding:2px !important;">Heat No</th>
          <th style="padding:2px !important;">Thk / Sch</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">R/H</th>
          <th style="padding:2px !important;">F/C</th>
          <th style="padding:2px !important;">R/H</th>
          <th style="padding:2px !important;">F/C</th>

          <!-- BUTTERING FOR EQUINOX ONLY -->
          <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
            <th style="padding:2px !important;">Report</th>
          <?php } ?>
          <!-- BUTTERING FOR EQUINOX ONLY -->

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>

          <th style="padding:2px !important;">Report</th>
          <th style="padding:2px !important;">Date</th>
          <th style="padding:2px !important;">Result</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $array_qc_approval = array(0, 1, 2, 4, 6, 8, 9, 10, 11);


        foreach ($wtr_list as $key => $value) {
          //if($value['fitup_status_inspection'] != 2 AND $value['visual_status_inspection'] != 2){
          $pc_pos_1                   = @$status_piecemark[$value['pos_1']];
          $pc_pos_2                   = @$status_piecemark[$value['pos_2']];

          $itr_pos_1    = false;
          $itr_pos_2    = false;

          if (isset($status_piecemark_itr[$value['pos_1']])) {
            $pc_pos_1     = $status_piecemark_itr[$value['pos_1']];
            $itr_pos_1    = true;
          }

          if (isset($status_piecemark_itr[$value['pos_2']])) {
            $pc_pos_2     = $status_piecemark_itr[$value['pos_2']];
            $itr_pos_2    = true;
          }

        ?>

          <?php

          $project_id_enc                 = strtr($this->encryption->encrypt($value['project']), '+=/', '.-~');
          $discipline_enc                 = strtr($this->encryption->encrypt($value['discipline']), '+=/', '.-~');
          $discipline_enc_material_1      = strtr($this->encryption->encrypt($pc_pos_1['discipline']), '+=/', '.-~');
          $discipline_enc_material_2      = strtr($this->encryption->encrypt($pc_pos_2['discipline']), '+=/', '.-~');
          $type_of_module_enc             = strtr($this->encryption->encrypt($value['type_of_module']), '+=/', '.-~');
          $module_enc                     = strtr($this->encryption->encrypt($value['module']), '+=/', '.-~');
          $company_enc                    = strtr($this->encryption->encrypt($value['company_id']), '+=/', '.-~');

          $report_enc_mv_p1   = null;
          $report_no_rev_p1   = null;

          if (isset($pc_pos_1['report_number'])) {
            $report_enc_mv_p1   = strtr($this->encryption->encrypt($pc_pos_1['report_number']), '+=/', '.-~');
            $report_no_rev_p1   = strtr($this->encryption->encrypt($pc_pos_1['report_no_rev']), '+=/', '.-~');
          }

          $report_enc_mv_p2   = null;
          $report_no_rev_p2   = null;

          if (isset($pc_pos_2['report_number'])) {
            $report_enc_mv_p2   = strtr($this->encryption->encrypt($pc_pos_2['report_number']), '+=/', '.-~');
            $report_no_rev_p2   = strtr($this->encryption->encrypt($pc_pos_2['report_no_rev']), '+=/', '.-~');
          }

          $report_fitup_enc  = null;

          if (isset($value['fitup_report_no'])) {
            $report_fitup_enc   = strtr($this->encryption->encrypt($value['fitup_report_no']), '+=/', '.-~');
          }

          $report_visual_enc  = null;

          if (isset($value['visual_report_no'])) {
            $report_visual_enc   = strtr($this->encryption->encrypt($value['visual_report_no']), '+=/', '.-~');
          }

          ?>

          <tr>
            <td style="padding:2px !important;">
              <?php echo $value['drawing_wm']; ?><br />
            </td>
            <td style="padding:2px !important;"><?php echo $drawing_detail[$loop_val["project"]][$value['drawing_wm']]['last_revision_no']; ?></td>
            <td style="padding:2px !important;"><?php echo $value['joint_no'] . $value['revision_category'] . $value['revision']; ?></td>
            <td style="padding:2px !important;"><?php echo (isset($class_list[$value['class']]) ? $class_list[$value['class']] : "-"); ?></td>
            <td style="padding:2px !important;"><?php echo $master_weld_type[$value['weld_type']]["weld_type_code"]; ?></td>
            <td style="padding:2px !important;"><?php echo $value['weld_length']; ?></td>
            <td style="padding:2px !important;"><?php echo $value['diameter']; ?></td>
            <td style="padding:2px !important;"><?php echo $value['thickness']; ?></td>
            <td style="padding:2px !important;">

              <?php echo $value['pos_1']; ?>
              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                <br /><br />
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                foreach ($data_multiple_piecemark_1 as $vaxx) {

                  if (isset($status_piecemark_ref_1[$vaxx])) {

                    echo  $status_piecemark_ref_1[$vaxx]["part_id"] . "<br/><br/> ";
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    echo  $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "<br/><br/> ";
                  }
                }
                ?>
              <?php } ?>
            </td>

            <td style="padding:2px !important;" <?= (in_array($pc_pos_1['status_inspection'], $array_qc_approval) && isset($pc_pos_1['status_inspection']) ? "class='color_pending_QC'" : null) ?>>

              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>

                <?php

                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {


                  if (isset($status_piecemark_ref_1[$vaxx])) {

                    if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']) and $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'] == 7) {
                      echo $report_no_mv[$value['project']][$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'];
                    } else {
                      if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'])) {
                        echo $report_no_mv[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'];
                      } else {
                        echo "-";
                      }
                    }
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    $report_number = "-";

                    if ($status_piecemark_ref_1_itr[$vaxx]['report_number']) {
                      $report_number  = $status_piecemark_ref_1_itr[$vaxx]['report_number'];
                      $report_number  = $report_no_itr[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_scm' : '')] . '-' . $report_number;
                    }

                    if ($status_piecemark_ref_1_itr[$vaxx]['transmittal_uniqid']) {

                      $report_number_link  = base_url() . "itr/itr_pdf/report/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_number']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_no_rev']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['project_code']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['discipline']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['type_of_module']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['module']);

                      $report_number   = $report_number;
                    }

                    echo $report_number;
                  }

                  // FOR ITR



                }
                ?>

              <?php } else { ?>


                <?php if (isset($pc_pos_1['report_number']) and $pc_pos_1['status_inspection'] >= 3) { ?>

                  <?php

                  $drawing_mv_enc = strtr($this->encryption->encrypt($pc_pos_1['drawing_no']), '+=/', '.-~');

                  $link_report_1    = base_url() . "material_verification/detail_client_rfi/$project_id_enc/$discipline_enc_material_1/$type_of_module_enc/$module_enc/$report_enc_mv_p1/$report_no_rev_p1/detail/$drawing_mv_enc";

                  $report_number_1  = @$report_no_mv[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_1['report_number'];

                  if ($pc_pos_1['status_inspection'] != 5) {

                    $link_report_1    = base_url() . "material_verification/material_verification_pdf_client/$project_id_enc/$discipline_enc_material_1/$type_of_module_enc/$module_enc/$report_enc_mv_p1/$report_no_rev_p1/$drawing_mv_enc";
                  }

                  if ($itr_pos_1) {
                    $report_number_1  = @$report_no_itr[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_1['report_number'];

                    $link_report_1    = base_url() . "itr/itr_pdf/report/$report_enc_mv_p1/$report_no_rev_p1/$project_id_enc/$discipline_enc_material_1/$type_of_module_enc/$module_enc";
                  }

                  ?>
                  <?= $report_number_1 ?>

                <?php } else { ?>

                  <?php

                  $report_number_1    = "-";
                  if ($pc_pos_1['report_number']) {
                    $report_number_1  = @$report_no_mv[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_1['report_number'];

                    if ($itr_pos_1) {
                      $report_number_1  = @$report_no_itr[$value['project']][$pc_pos_1['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_1"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_1['report_number'];
                    }
                  }

                  $link_report_1        = base_url() . "material_verification/material_verification_pdf/" . encrypt($pc_pos_1['submission_id']);

                  if ($itr_pos_1) {
                    $link_report_1        = base_url() . "itr/itr_pdf/submission/" . encrypt($pc_pos_1['submission_id']);
                  }

                  ?>

                  <?php if ($pc_pos_1['status_inspection'] == 1) { ?>
                    <?= $pc_pos_1['submission_id'] ?>
                  <?php } else { ?>
                    <?= $report_number_1 ?>
                  <?php } ?>

                <?php } ?>

              <?php } ?>



            </td>

            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {

                    echo  $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    echo  $material_grade[$status_piecemark[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_1['id_mis'])) {
                  echo $material_grade[$pc_pos_1['grade']]['material_grade'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  //echo  "<span class='badge'>".$status_piecemark_ref_1[$vaxx]["part_id"]."</span> <br/>"; 

                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    echo $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_1['id_mis'])) {
                  echo $warehouse_mis_mrir[$pc_pos_1['id_mis']]['unique_ident_no'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {

                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                    echo  $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_1['id_mis'])) {
                  echo $warehouse_mis_mrir[$pc_pos_1['id_mis']]['heat_or_series_no'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_1']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_1']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_1']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_1']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {


                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                    echo  $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['thickness'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_1['id_mis'])) {
                  echo $pc_pos_1['thickness'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php echo $value['pos_2']; ?>
              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                <br /><br />
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo  $status_piecemark_ref_1[$vaxx]["part_id"] . "<br/><br/>";
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                    echo  $status_piecemark_ref_1_itr[$vaxx]["part_id"] . "<br/><br/>";
                  }
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;" <?= (in_array($pc_pos_2['status_inspection'], $array_qc_approval) && isset($pc_pos_2['status_inspection']) ? "class='color_pending_QC'" : null) ?>>


              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>

                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {

                    if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number']) and $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['status_inspection'] == 7) {
                      echo $report_no_mv[$value['project']][$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'];
                    } else {
                      if (isset($status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'])) {
                        echo $report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['report_number'];
                      } else {
                        echo "-";
                      }
                    }
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    $report_number = "-";

                    if ($status_piecemark_ref_1_itr[$vaxx]['report_number']) {
                      $report_number  = $status_piecemark_ref_1_itr[$vaxx]['report_number'];
                      $report_number  = $report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . '-' . $report_number;
                    }

                    if ($status_piecemark_ref_1_itr[$vaxx]['transmittal_uniqid']) {

                      $report_number_link  = base_url() . "itr/itr_pdf/report/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_number']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['report_no_rev']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['project_code']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['discipline']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['type_of_module']) . "/" . encrypt($status_piecemark_ref_1_itr[$vaxx]['module']);

                      $report_number   = $report_number;
                    }

                    echo $report_number;
                    echo '<br><br>';
                  }
                }
                ?>

              <?php } else { ?>


                <?php if (isset($pc_pos_2['report_number']) and $pc_pos_2['status_inspection'] >= 3) { ?>

                  <?php

                  $drawing_mv_enc = strtr($this->encryption->encrypt($pc_pos_2['drawing_no']), '+=/', '.-~');

                  $link_report_2    = base_url() . "material_verification/detail_client_rfi/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc/$report_enc_mv_p2/$report_no_rev_p2/detail/$drawing_mv_enc";

                  $report_number_2  = @$report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_2['report_number'];

                  if ($pc_pos_2['status_inspection'] != 5) {

                    $link_report_2    = base_url() . "material_verification/material_verification_pdf_client/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc/$report_enc_mv_p2/$report_no_rev_p2/$drawing_mv_enc";
                  }

                  if ($itr_pos_2) {
                    $report_number_2  = @$report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_2['report_number'];

                    $link_report_2    = base_url() . "itr/itr_pdf/report/$report_enc_mv_p2/$report_no_rev_p2/$project_id_enc/$discipline_enc_material_2/$type_of_module_enc/$module_enc";
                  }

                  ?>
                  <?= $report_number_2 ?></a>

                <?php } else { ?>

                  <?php

                  $report_number_2    = "-";
                  if ($pc_pos_2['report_number']) {
                    $report_number_2  = @$report_no_mv[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['mv_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_smop' : '')] . "-" . $pc_pos_2['report_number'];

                    if ($itr_pos_2) {
                      $report_number_2  = @$report_no_itr[$value['project']][$pc_pos_2['discipline']][$value['type_of_module']]['itr_no' . ($status_piecemark[$value["pos_2"]]["company_id"] == 13 ? '_scm' : '')] . "-" . $pc_pos_2['report_number'];
                    }
                  }

                  $link_report_2        = base_url() . "material_verification/material_verification_pdf/" . encrypt($pc_pos_2['submission_id']);

                  if ($itr_pos_2) {
                    $link_report_2        = base_url() . "itr/itr_pdf/submission/" . encrypt($pc_pos_2['submission_id']);
                  }

                  ?>

                  <?php if ($pc_pos_2['status_inspection'] == 1) { ?>
                    <?= $pc_pos_2['submission_id'] ?>
                  <?php } else { ?>
                    <?= $report_number_1 ?>
                  <?php } ?>

                <?php } ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo  $material_grade[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['grade']]['material_grade'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                    echo $material_grade[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['grade']]['material_grade'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_2['id_mis'])) {
                  echo $material_grade[$pc_pos_2['grade']]['material_grade'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {

                    echo $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['unique_ident_no'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_2['id_mis'])) {
                  echo $warehouse_mis_mrir[$pc_pos_2['id_mis']]['unique_ident_no'];
                }
                ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                array_unshift($data_multiple_piecemark_1, $status_piecemark_ref[$value['pos_2']]['id']);

                foreach ($data_multiple_piecemark_1 as $vaxx) {
                  if (isset($status_piecemark_ref_1[$vaxx])) {

                    echo $warehouse_mis_mrir[$status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'];
                  } elseif ($status_piecemark_ref_1_itr[$vaxx]) {

                    echo $warehouse_mis_mrir[$status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['id_mis']]['heat_or_series_no'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_2['id_mis'])) {
                  echo $warehouse_mis_mrir[$pc_pos_2['id_mis']]['heat_or_series_no'];
                }
                ?>
              <?php }  ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($status_piecemark_ref[$value['pos_2']]["ref_pos_1"]) && !empty($status_piecemark_ref[$value['pos_2']]["ref_pos_1"])) { ?>
                <?php
                $data_multiple_piecemark_1 = explode(", ", $status_piecemark_ref[$value['pos_2']]["ref_pos_1"]);
                foreach ($data_multiple_piecemark_1 as $vaxx) {

                  if (isset($status_piecemark_ref_1[$vaxx])) {
                    echo $status_piecemark[$status_piecemark_ref_1[$vaxx]["part_id"]]['thickness'];
                  } elseif (isset($status_piecemark_ref_1_itr[$vaxx])) {
                    echo $status_piecemark_itr[$status_piecemark_ref_1_itr[$vaxx]["part_id"]]['thickness'];
                  }
                }
                ?>
              <?php } else { ?>
                <?php
                if (isset($pc_pos_2['id_mis'])) {
                  echo $pc_pos_2['thickness'];
                }
                ?>
              <?php } ?>
            </td>

            <!-- BUTTERING FOR EQUINOX ONLY -->
            <?php if ($show_data_irn_list[0]['project'] == 19) { ?>
              <td style="padding:2px !important;">
                <?= $buttering[$value["id_joint"]]["report_number"] ?>
              </td>
            <?php } ?>
            <!-- BUTTERING FOR EQUINOX ONLY -->

            <td style="padding:2px !important;" <?= (in_array($value['fitup_status_inspection'], $array_qc_approval) && !empty($value['fitup_status_inspection'])  ? "class='color_pending_QC'" : null) ?>>

              <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>

                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                  <?php if ($value['fitup_status_inspection'] != 5) { ?>
                    <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?>
                  <?php } else { ?>
                    <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?>
                  <?php } ?>
                <?php } else { ?>
                  <?php if (in_array($value['fitup_status_inspection'], array(1, 3))) { ?>
                    <?php echo $value['fitup_submission_id']; ?>
                  <?php } else { ?>
                    <?php if (isset($value['fitup_report_no'])) { ?>
                      <?php echo $report_no_fu[$value['project']][$value['discipline']][$value['type_of_module']]['fitup_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value['fitup_report_no']; ?>
                    <?php } else { ?>
                      -
                    <?php } ?>
                  <?php } ?>
                <?php } ?>

              <?php } ?>

            </td>
            <td style='padding:2px !important;' <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? (date("Y-m-d", strtotime($value['weld_datetime'])) < $value['fitup_inspection_datetime'] && isset($value['fitup_report_no']) && isset($value['weld_datetime']) ? "class='color_date'" : null) : null) ?>>
              <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>
                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                  <?php echo date("Y-m-d", strtotime($value['fitup_inspection_datetime'])); ?>
                <?php } else { ?>
                  -
                <?php } ?>
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (!isset($value['revision_category']) && !isset($value['revision'])) { ?>
                <?php if (isset($value['fitup_report_no']) && $value['fitup_status_inspection'] >= 3) { ?>
                  ACC
                <?php } else { ?>
                  -
                <?php } ?>
              <?php } ?>
            </td>

            <td style="padding:2px !important;">
              <?php
              $tack_weld_id = explode(";", $value['tack_weld_id']);
              if (sizeof($tack_weld_id) > 0) {
                foreach ($tack_weld_id as $key => $tack_weld_id_name) {
                  if (isset($master_welder[$tack_weld_id_name]["rwe_code"])) {
                    echo $master_welder[$tack_weld_id_name]["rwe_code"] . "<br/>";
                  }
                }
              }
              ?>
            </td>

            <td style="padding:2px !important;">
              <?php
              $wps_rh = explode(";", $value['wps_no_rh']);
              $wps_fc = explode(";", $value['wps_no_fc']);
              $wps_show = array_unique(array_merge($wps_rh, $wps_fc));
              if (sizeof($wps_show) > 0) {
                foreach ($wps_show as $key => $wps_id) {
                  if (isset($wps_code_arr[$wps_id])) {
                    echo $wps_code_arr[$wps_id] . "<br/>";
                  }
                }
              }
              ?>
            </td>

            <td style="padding:2px !important;"><?php echo $value['cons_lot_no']; ?></td>

            <td style="padding:2px !important;" <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? (date("Y-m-d", strtotime($value['visual_inspection_datetime'])) < date("Y-m-d", strtotime($value['weld_datetime'])) && isset($value['visual_inspection_datetime']) ? "class='color_date'" : null) : null) ?>><?php echo $value['weld_datetime']; ?></td>

            <td style="padding:2px !important;">
              <?php
              // if($value["process_gtaw_rh"] > 0){ echo "GTAW <br/>"; }
              // if($value["process_gmaw_rh"] > 0){ echo "GMAW <br/>"; }
              // if($value["process_smaw_rh"] > 0){ echo "SMAW <br/>"; }
              // if($value["process_fcaw_rh"] > 0){ echo "FCAW <br/>"; }
              // if($value["process_saw_rh"]  > 0){ echo "SAW <br/>"; }

              $arr_weld_process_rh = explode(";", $value['weld_process_rh']);
              echo join(", ", $arr_weld_process_rh);
              ?>
            </td>

            <td style="padding:2px !important;">
              <?php
              // if($value["process_gtaw_fc"] > 0){ echo "GTAW <br/>"; }
              // if($value["process_gmaw_fc"] > 0){ echo "GMAW <br/>"; }
              // if($value["process_smaw_fc"] > 0){ echo "SMAW <br/>"; }
              // if($value["process_fcaw_fc"] > 0){ echo "FCAW <br/>"; }
              // if($value["process_saw_fc"]  > 0){ echo "SAW <br/>"; }

              $arr_weld_process_fc = explode(";", $value['weld_process_fc']);
              echo join(", ", $arr_weld_process_fc);
              ?>
            </td>

            <td style="padding:2px !important;">
              <?php
              $welder_rh = explode(";", $value['welder_ref_rh']);
              if (sizeof($welder_rh) > 0) {
                foreach ($welder_rh as $key => $welder_id_rh) {
                  if (isset($master_welder[$welder_id_rh]["rwe_code"])) {
                    echo $master_welder[$welder_id_rh]["rwe_code"] . "<br/>";
                  }
                }
              }
              ?>
            </td>

            <td style="padding:2px !important;">
              <?php
              $welder_fc = explode(";", $value['welder_ref_fc']);
              if (sizeof($welder_fc) > 0) {
                foreach ($welder_fc as $key => $welder_id_fc) {
                  if (isset($master_welder[$welder_id_fc]["rwe_code"])) {
                    echo $master_welder[$welder_id_fc]["rwe_code"] . "<br/>";
                  }
                }
              }
              ?>
            </td>

            <td style="padding:2px !important;" <?= (in_array($value['visual_status_inspection'], $array_qc_approval) && !empty($value['visual_status_inspection']) ? "class='color_pending_QC'" : null) ?>>

              <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>

                <?php if ($value['visual_status_inspection'] != 5) { ?>

                  <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?>

                <?php } else { ?>

                  <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?>

                <?php } ?>

              <?php } else { ?>


                <?php if (in_Array($value['visual_status_inspection'], array(1, 3))) { ?>

                  <?php echo $value['visual_submission_id']; ?>

                <?php } else { ?>

                  <?php if (isset($value['visual_report_no'])) { ?>
                    <?php echo $report_no_vs[$value['project']][$value['discipline']][$value['type_of_module']]['visual_report' . ($value['company_id'] == 13 ? '_13' : '')] . $value['visual_report_no']; ?>
                  <?php } else { ?>
                    -
                  <?php } ?>

                <?php } ?>

              <?php } ?>

              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                $total_doble = array();
                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key03 => $val03) {
                  $total_doble[] = ($val03['date_of_inspection'] < date("Y-m-d", strtotime($value['visual_inspection_datetime'])) ? 1 : 0);
                }
                $total_ut = array_sum($total_doble);
              } else {
                $total_ut = 0;
              }

              if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                $total_doble_MT = array();
                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key02 => $val02) {
                  $total_doble_MT[] = ($val02['date_of_inspection'] < date("Y-m-d", strtotime($value['visual_inspection_datetime'])) ? 1 : 0);
                }
                $total_mt = array_sum($total_doble_MT);
              } else {
                $total_mt = 0;
              }

              $validate = $total_ut + $total_mt;
              ?>
            </td>
            <td style="padding:2px !important;" <?= ($this->permission_cookie[0] == 1 || $this->permission_cookie[156] == 1 ? ($validate > 0 ? "class='color_date'" : null) : null) ?>>
              <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>
                <?php echo date("Y-m-d", strtotime($value['visual_inspection_datetime'])); ?>
              <?php } else { ?>
                -
              <?php } ?>
            </td>
            <td style="padding:2px !important;">
              <?php if (isset($value['visual_report_no']) and $value['visual_status_inspection'] >= 3) {  ?>
                ACC
              <?php } else { ?>
                -
              <?php } ?>
            </td>

            <td style="padding:2px !important;">

              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']]);
              } else {
                $total_arr[$key] = 0;
              }

              if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key02 => $val02) {
              ?>
                  <?php if (isset($val02['filename'])) {  ?>

                    <?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?>

                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    <?= @$val02['report_number'] ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key03 => $val03) {
              ?>
                  <?php if (isset($val03['report_number'])) {  ?>
                    <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    - <?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">

              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][2][$value['revision_category']][$value['revision']] as $key04 => $val04) {

              ?>
                  <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                    OS
                  <?php } else if ($val04['result'] == 1) {  ?>
                    <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                  echo "<hr/>";
                                } ?>
                  <?php } else if ($val04['result'] == 2) {  ?>
                    <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                      echo "<hr/>";
                                    } ?>
                  <?php } else { ?>
                    -<?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>

            </td>

            <td style="padding:2px !important;">
              <?php

              if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']]);
              } else {
                $total_arr[$key] = 0;
              }

              if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key02 => $val02) {
              ?>
                  <?php if (isset($val02['filename'])) {  ?>
                    <?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    <?= @$val02['report_number'] ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key03 => $val03) {
              ?>
                  <?php if (isset($val03['report_number'])) {  ?>
                    <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    - <?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][7][$value['revision_category']][$value['revision']] as $key04 => $val04) {
              ?>
                  <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                    OS
                  <?php } else if ($val04['result'] == 1) {  ?>
                    <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                  echo "<hr/>";
                                } ?>
                  <?php } else if ($val04['result'] == 2) {  ?>
                    <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                      echo "<hr/>";
                                    } ?>
                  <?php } else { ?>
                    -<?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>

            </td>

            <td style="padding:2px !important;">
              <?php

              if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']]);
              } else {
                $total_arr[$key] = 0;
              }

              if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key02 => $val02) {
              ?>
                  <?php if (isset($val02['filename'])) {  ?>
                    <?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    <?= @$val02['report_number'] ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key03 => $val03) {
              ?>
                  <?php if (isset($val03['report_number'])) {  ?>
                    <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    - <?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][3][$value['revision_category']][$value['revision']] as $key04 => $val04) {
              ?>
                  <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                    OS
                  <?php } else if ($val04['result'] == 1) {  ?>
                    <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                  echo "<hr/>";
                                } ?>
                  <?php } else if ($val04['result'] == 2) {  ?>
                    <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                      echo "<hr/>";
                                    } ?>
                  <?php } else { ?>
                    -<?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>

            </td>


            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                $total_arr[$key] = sizeof($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']]);
              } else {
                $total_arr[$key] = 0;
              }
              ?>
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key02 => $val02) {
              ?>
                  <?php if (isset($val02['filename'])) {  ?>
                    <?= @$val02['report_number'] . ($val02["attachment_revision"] ? '-' . $val02["attachment_revision"] : '') ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    <?= @$val02['report_number'] ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key03 => $val03) {
              ?>
                  <?php if (isset($val03['report_number'])) {  ?>
                    <?= DATE('Y-m-d', strtotime($val03['date_of_inspection'])) ?>
                    <?php if ($total_arr[$key] > 1) {
                      echo "<hr/>";
                    } ?>
                  <?php } else { ?>
                    - <?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>
            </td>
            <td style="padding:2px !important;">
              <?php
              if (isset($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']])) {
                foreach ($ndt_all_2[$value['id_joint_visual']][1][$value['revision_category']][$value['revision']] as $key04 => $val04) {
              ?>
                  <?php if ($val04['result'] == 0 and isset($val04['result'])) {  ?>
                    OS
                  <?php } else if ($val04['result'] == 1) {  ?>
                    <?= "ACC" ?><?php if ($total_arr[$key] > 1) {
                                  echo "<hr/>";
                                } ?>
                  <?php } else if ($val04['result'] == 2) {  ?>
                    <?= "REJECT" ?><?php if ($total_arr[$key] > 1) {
                                      echo "<hr/>";
                                    } ?>
                  <?php } else { ?>
                    -<?php if ($total_arr[$key] > 1) {
                        echo "<hr/>";
                      } ?>
                  <?php } ?>
              <?php
                }
              } else {
                echo "-";
              }
              ?>

            </td>

            <td style="padding:2px !important;">
              <?= (isset($value["irn_report_no"]) ? $report_no_irn[$value['project']][$value['discipline']][$value['type_of_module']]['irn_report' . ($value['company_id'] == 13 ? '_scm' : '')] . $value["irn_report_no"] : (isset($value["irn_submission_id"]) ? "Draft" : "-")) ?>
            </td>
            <td style="padding:2px !important;"><?= @isset($value['irn_status_inspection']) && $value['irn_status_inspection'] == 7 ? date("Y-m-d", strtotime($value['irn_client_approval_date'])) : "-"  ?></td>
            <td style="padding:2px !important;"><?= @isset($value['irn_status_inspection']) && $value['irn_status_inspection'] == 7 ? 'ACC' : "-" ?></td>

            <td style="padding:2px !important;"><?php if (isset($status_piecemark[$value['pos_1']]['id_mis'])) {
                                                  echo str_replace("\n", "<br/>", $value["visual_remarks"]);
                                                } ?></td>
          </tr>
        <?php
        }
        $array_approval = array(7, 9);
        ?>
      </tbody>
    </table>
    <br /><br />
    <table width="100%">
      <tr>
        <td colspan="16">
          <table class="table-body" width="100%" style="text-align: left; border-collapse: collapse !important;">
            <tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr>
            <tr>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                      <?php if (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"])) { ?>
                        <img style="width:100px;" src="data:image/png;base64, <?= (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"]) ? $sign_approval[$wtr_list[0]["mwtr_signed_smoe_approval_by"]] : "-") ?>">
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    <?php if (isset($show_pcms_irn[0]["smoe_approval_by"])) { ?>
                      <img style="width:100px;" src="data:image/png;base64, <?= (isset($show_pcms_irn[0]["smoe_approval_by"]) ? $sign_approval[$show_pcms_irn[0]["smoe_approval_by"]] : "-") ?>">
                    <?php } ?>
                  <?php }  ?>
                <?php } // is wtr 
                ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                      <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                        <img style="width:100px;" src="data:image/png;base64, <?= (isset($wtr_list[0]["mwtr_signed_client_approval_by"]) ? $sign_approval[$wtr_list[0]["mwtr_signed_client_approval_by"]] : "-") ?>">
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    <?php if (isset($show_pcms_irn[0]["client_approval_by"]) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval)) { ?>
                      <img style="width:100px;" src="data:image/png;base64, <?= (isset($show_pcms_irn[0]["client_approval_by"]) ? $sign_approval[$show_pcms_irn[0]["client_approval_by"]] : "-") ?>">
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr>
            <tr>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;"></td>
            </tr>
            <tr>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "1") { ?>

                      <?php if ($this->permission_cookie[63] == 1 || $this->permission_cookie[0] == 1) { ?>

                        <a href="<?= base_url() ?>wtr/update_status_approval/<?= strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($value["mwtr_signed_submission_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt(3), '+=/', '.-~') ?>" class="buttonxx button5xx" onclick="confirm('Are you sure?')">Digital Sign</a>

                      <?php } ?>

                    <?php } else if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                      <?= (isset($wtr_list[0]['mwtr_signed_smoe_approval_by']) ? $user_list[$wtr_list[0]['mwtr_signed_smoe_approval_by']] : '') ?>
                    <?php } ?>
                  <?php } else { ?>
                    <?php if (isset($show_pcms_irn[0]["smoe_approval_by"])) { ?>
                      <?= (isset($show_pcms_irn[0]['smoe_approval_by']) ? $user_list[$show_pcms_irn[0]['smoe_approval_by']] : '') ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
                <br>
                <b>______________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] == "5") { ?>

                      <?php if ($this->user_cookie[7] == 8 || $this->permission_cookie[0] == 1) { ?>

                        <style type="text/css">
                          .disabled-style {
                            pointer-events: none;
                            cursor: default;
                            background-color: dimgrey;
                            color: linen;
                            opacity: 1;
                          }

                          .d-none {
                            display: none;
                          }
                        </style>
                        <?php
                        $acc = strtr($this->encryption->encrypt(7), '+=/', '.-~');
                        $acc_witch_comment = strtr($this->encryption->encrypt(9), '+=/', '.-~');
                        $reoffer = strtr($this->encryption->encrypt(11), '+=/', '.-~');

                        $uniq_id = strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~');
                        $submission_id = strtr($this->encryption->encrypt($value["mwtr_signed_submission_id"]), '+=/', '.-~');
                        ?>
                        <form method="POST" action="<?= base_url() ?>wtr/update_status_approval_v2/">
                          <input type="hidden" name="uniq_id" value="<?= $uniq_id ?>">
                          <input type="hidden" name="submission_id" value="<?= $submission_id ?>">
                          <select name="status_inspection_client" onchange="changeLink(this)">
                            <option value="">---</option>
                            <option value="7">Accepted</option>
                            <option value="9">Accepted & Released with Comment</option>
                            <option value="11">Re-Offer</option>
                          </select>
                          <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-3.4.1.min.js"></script>
                          <script type="text/javascript">
                            function changeLink(ini) {
                              var status = $(ini).val()
                              if (status != '') {
                                $('.submit').removeClass('d-none')
                                if (status == 9 || status == 11) {
                                  $('.client_remarks').removeClass('d-none')
                                } else {
                                  $('.client_remarks').addClass('d-none')
                                }
                              } else {
                                $('.submit').addClass('d-none')
                              }
                            }
                          </script>
                          <textarea name="client_remarks" class="client_remarks d-none" rows="4" cols="50"></textarea>
                          <button type="submit" class="buttonxx button5xx d-none submit" onclick="confirm('Are you sure?')">Digital Sign</button>
                        </form>
                        <!-- <a href="<?= base_url() ?>wtr/update_status_approval/<?= strtr($this->encryption->encrypt($value["mwtr_signed_uniq_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt($value["mwtr_signed_submission_id"]), '+=/', '.-~') ?>/<?= strtr($this->encryption->encrypt(7), '+=/', '.-~') ?>" class="buttonxx button5xx" onclick="confirm('Are you sure?')">Digital Sign</a> -->

                      <?php } ?>

                    <?php } else if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                      <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? $user_list[$wtr_list[0]['mwtr_signed_client_approval_by']] : '') ?>
                    <?php } ?>
                  <?php } else { ?>
                    <?php if (isset($show_pcms_irn[0]["client_approval_by"]) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval)) { ?>
                      <?= isset($user_list[$show_pcms_irn[0]['client_approval_by']]) ? $user_list[$show_pcms_irn[0]['client_approval_by']] : null ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
                <br>
                <b>______________</b>
              </td>
              <td style="width: 25%; border: none;"><b></b>
              </td>
              <td style="width: 25%; border: none;">
                <br>
                <b>______________</b>
              </td>
            </tr>
            <tr>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>CONTRACTOR</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>EMPLOYER</b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b></b></td>
              <td style="width: 25%; border: none; padding-top: 10px;"><b>THIRD PARTY <i>( If Any )</i></b></td>
            </tr>
            <tr>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 3) { ?>
                      <?php if (isset($wtr_list[0]["mwtr_signed_smoe_approval_by"])) { ?>
                        DATE : <?= (isset($wtr_list[0]['mwtr_signed_smoe_approval_by']) ? date("d M Y", strtotime($wtr_list[0]['mwtr_signed_smoe_approval_date'])) : '') ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    DATE : <?= (isset($show_pcms_irn[0]['smoe_approval_date']) ? date("d M Y", strtotime($show_pcms_irn[0]['smoe_approval_date'])) : '') ?>
                  <?php } ?>
                <?php } else {
                  echo "DATE : ";
                } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">
                <?php if ($is_wtr != 'wtr') { ?>
                  <?php if (isset($for_mwtr_signed)) { ?>
                    <?php if ($wtr_list[0]['mwtr_signed_status_inspection'] >= 5) { ?>
                      <?php if (isset($wtr_list[0]["mwtr_signed_client_approval_by"])) { ?>
                        DATE : <?= (isset($wtr_list[0]['mwtr_signed_client_approval_by']) ? date("d M Y", strtotime($wtr_list[0]['mwtr_signed_client_approval_date'])) : '') ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    DATE : <?= isset($show_pcms_irn[0]['client_approval_by']) && in_array($show_pcms_irn[0]["status_inspection"], $array_approval) ? date("d M Y", strtotime($show_pcms_irn[0]['client_approval_date'])) : ''; ?>
                  <?php } ?>
                <?php } else {
                  echo "DATE : ";
                } ?>
              </td>
              <td style="width: 25%; border: none;"></td>
              <td style="width: 25%; border: none;">DATE : </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <?php if ($no != $no_max) { ?>
      <div class="page_break"></div>
    <?php } ?>

  <?php $no++;
  } ?>
</body>

</html>