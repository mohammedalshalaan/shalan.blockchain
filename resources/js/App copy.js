import React, { useState, useEffect } from 'react';
import getBlockchain from './ethereum.js';

function App() {
  const [simpleStorage, setSimpleStorage] = useState(undefined);
  const [data, setData] = useState(undefined);
  const [owner, setOwner] = useState(undefined);
  const [myBlock, setBlock] = useState(undefined);
  const [lastBlock, setLastBlock] = useState(undefined);
  const [coin, setCoin] = useState(undefined);
  const [blockNumber, setBlockNumber] = useState(undefined);

  useEffect(() => {
    const init = async () => {
      const { simpleStorage } = await getBlockchain();
    
      const data = await simpleStorage.readData();
      const owner = await simpleStorage.readOwner();
      const myBlock = await simpleStorage.readThisAddress();
      const lastBlock = await simpleStorage.readBlockHash();
      const coin = await simpleStorage.readCoin();
      const blockNumber = await simpleStorage.readBlockNumber();
      setSimpleStorage(simpleStorage);
      setData(data);
      setOwner(owner);
      setBlock(myBlock);
      setLastBlock(lastBlock);
      setCoin(coin);
      setBlockNumber(blockNumber);
    };
    init();
  }, []);

  const updateData = async e => {
    e.preventDefault();
    const data = e.target.elements[0].value;
    const tx = await simpleStorage.updateData(data);
    
    await tx.wait();
    const newData = await simpleStorage.readData();
    const newData1 = await simpleStorage.readOwner();
    const newData2 = await simpleStorage.readCoin();
    const newData3 = await simpleStorage.readBlockNumber();
    setData(newData);
    setOwner(newData1);
    setCoin(newData2);
    setBlockNumber(newData3);
  };

  if(
    typeof simpleStorage === 'undefined'
    || typeof data === 'undefined'
    || typeof owner === 'undefined'
    || typeof myBlock === 'undefined'
    || typeof lastBlock === 'undefined'
    || typeof coin === 'undefined'
    || typeof blockNumber === 'undefined'
   
  ) {
    return 'Loading...';
  }


  return (
    <div className='container'>
      <div className='row'>

        <div className='col-sm-6'>
          <h2>Data:</h2>
          <p>{data.toString()}</p>
        </div>

        <div className='col-sm-6'>
          <h2>Owner:</h2>
          <p>{owner.toString()}</p>
        </div>

        <div className='col-sm-6'>
          <h2>This Address:</h2>
          <p>{myBlock.toString()}</p>
        </div>

        <div className='col-sm-6'>
          <h2>The LastBlock:</h2>
          <p>{lastBlock.toString()}</p>
        </div>

        <div className='col-sm-6'>
          <h2>The CoinBase:</h2>
          <p>{coin.toString()}</p>
        </div>

        <div className='col-sm-6'>
          <h2>The blockNumber :</h2>
          <p>{blockNumber.toString()}</p>
        </div>



       
        <div className='col-sm-6'>
          <h2>Change data</h2>
          <form className="form-inline" onSubmit={e => updateData(e)}>
            <input 
              type="text" 
              className="form-control" 
              placeholder="zero"
            />

            

            <button 
              type="submit" 
              className="btn btn-primary"
            >
              Submit
            </button>
          </form>
        </div>

      </div>
    </div>
  );
}
export default App;